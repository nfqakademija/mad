<?php

namespace AppBundle\Controller;

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
        $scheduleId = $mealsScheduleService->getUserSchedules($this->getUser());

        return new JsonResponse($scheduleId);
    }

    /**
     * @Route("/userSchedule/{id}", name="user_schedule")
     */
    public function getUserScheduleInfo() {
        $mealsScheduleService = $this->get('app.meals_schedule_service');
        $scheduleId = $mealsScheduleService->getUserSchedules($this->getUser());

        return new JsonResponse($scheduleId);
    }
}
