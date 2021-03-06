<?php

namespace AppBundle\Controller;

use AppBundle\Entity\UserMealsSchedules;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class MealScheduleController extends Controller
{
    /**
     * @Route("/addMealsToUser", name="save_user_schedule")
     */
    public function saveUserSchedule()
    {
        $mealsScheduleService = $this->get('app.meals_schedule_service');
        $scheduleId = $mealsScheduleService->saveScheduleToUser($this->getUser());

        return new Response($scheduleId);
    }

    /**
     * @Route("/userSchedules", name="user_schedules")
     */
    public function getUserSchedules() {
        $mealsScheduleService = $this->get('app.meals_schedule_service');
        $schedules = $mealsScheduleService->getUserSchedules($this->getUser());

        if(empty($schedules)) {
            $schedules = [['name' => 'Neturite nei vieno meniu.', 'id' => 0]];
        }
        return $this->render('@App/MealSchedule/user_schedules.twig',
            ['schedules' => $schedules]
        );
    }


    /**
     * @Route("/userSchedule/{id}", name="user_schedule")
     */
    public function getUserScheduleInfo($id) {
        $em = $this->getDoctrine()->getManager();
        $meals = $em->getRepository(UserMealsSchedules::class)->getScheduleMeals($id);

        $msg = '<div class="table">'.
        $day = 0;
        $mealNameAndId = [];
        foreach($meals as $meal2) {
            $meal = json_decode($meal2['mealJson']);
            $mealNameAndId[] = ['id' => $meal->id, 'name' => $meal->name, 'logo' => $meal->logo, 'day' => $meal2['week_day']];
            if($day != $meal2['week_day']) {
                if($day != 0) {
                    $msg .= '</ul>';
                }
                $day = $meal2['week_day'];
                $msg .= '<ul class="connected menu sort ui-sortable">';
                $msg .= '<li class="menu">'.$meal2['week_day'].' diena</li>';
            }

            $msg .= '<li class="menu">'
                    .'<p class="manu-name">'.$meal->name.'</p></li>';

        }
        $msg .= '</div>';

        return $this->render('@App/MealSchedule/user_schedule.twig',
            [
                'Meals' => $msg
            ]);
    }
}
