<?php

namespace AppBundle\Service;

use AppBundle\Entity\Meals;
use AppBundle\Entity\MealsWithIngredients;
use AppBundle\Entity\ScheduleDayMeals;
use AppBundle\Entity\ScheduleDays;
use AppBundle\Entity\User;
use AppBundle\Entity\UserMealsSchedules;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class mealScheduleService
{
    private $em;
    private $errorMsg;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function saveScheduleToUser(User $user) {

        $mealsWithUser = $this->getRequestInfo();

        /*$mealsWithUser = [
            [
                'id' => 3,
                'multiplier' => 1,
                'day' => 1,
                'order' => 1
            ],
            [
                'id' => 4,
                'multiplier' => 2,
                'day' => 1,
                'order' => 2
            ],
            [
                'id' => 5,
                'multiplier' => 2,
                'day' => 2,
                'order' => 1
            ],
            [
                'id' => 6,
                'multiplier' => 2,
                'day' => 2,
                'order' => 2
            ]
        ];*/

        $scheduleName = 'Tvarkaraštis_' . (count($this->em->getRepository(User::class)->findAll()) + 1);

        $userMealSchedule = new UserMealsSchedules();
        $userMealSchedule->setName($scheduleName);
        $userMealSchedule->setUser($user);
        $userMealSchedule->setTimeInserted(new \DateTime());
        $userMealSchedule->setTimeUpdated(new \DateTime());

        $dayNumber = 0;
        foreach($mealsWithUser as $meal) {
            if($dayNumber != $meal['day']) {
                $day = $this->createScheduleDay($mealsWithUser, $meal['day']);
                if($day) {
                    $userMealSchedule->addScheduleDay($this->createScheduleDay($mealsWithUser, $meal['day']));
                    $dayNumber = $meal['day'];
                } else {
                    return $this->errorMsg;
                }
            }
        }

        $this->em->persist($userMealSchedule);
        $this->em->flush();

        return $userMealSchedule->getId();
    }

    /**
     * Creates meals schedule day object
     * @param array $meals
     * @param integer $day
     *
     * @return mixed
     */
    private function createScheduleDay($meals, $day) {
        $scheduleDay = new ScheduleDays();
        $scheduleDay->setWeekDay($day);
        $scheduleDay->setTimeInserted(new \DateTime());
        $scheduleDay->setTimeUpdated(new \DateTime());

        foreach($meals as $meal) {
            if($meal['day'] == $day) {
                $mealObject = $this->createMeal($meal);
                if($mealObject) {
                    $scheduleDay->addMeal($this->createMeal($meal));
                } else {
                    return false;
                }
            }
        }

        return $scheduleDay;
    }

    /**
     * Creates meals schedule day meal object
     * @param array $meal
     *
     * @return mixed
     */
    private function createMeal($meal) {
        $scheduleDayMeal = new ScheduleDayMeals();
        $scheduleDayMeal->setMealCount($meal['multiplier']);
        $scheduleDayMeal->setDayMealsOrder($meal['order']);
        $scheduleDayMeal->setTimeInserted(new \DateTime());
        $scheduleDayMeal->setTimeUpdated(new \DateTime());

        $mealJson = $this->getMealWithIngredientsJSON($meal['id']);
        if($mealJson){
            $scheduleDayMeal->setMealJson($mealJson);
            return $scheduleDayMeal;
        } else {
            $this->errorMsg = 'No meal or ingredient found by id: ' . $meal['id'] . ' .';
            return false;
        }
    }

    /**
     * Gets meal with ingredients JSON
     * @param integer $mealId
     *
     * @return mixed
     */
    private function getMealWithIngredientsJSON($mealId) {
        $mealInfo = $this->em->getRepository(Meals::class)->getMealInfo($mealId);

        if($mealInfo) {
            $mealInfo[0]['ingredients'] = $this->em->getRepository(MealsWithIngredients::class)->getMealIngredients($mealId);
            if($mealInfo[0]['ingredients']) {
                return json_encode($mealInfo[0]);
            }
        }

        return false;
    }

    /**
     * Gets Ajax request values
     * @return mixed
     */
    private function getRequestInfo() {
        $request = Request::createFromGlobals();
        $request->getPathInfo();
        $mealsWithUser = $request->query->get('doc');

        return $mealsWithUser;
    }

    /**
     * Gets Ajax request values
     * @param User $user
     *
     * @return array
     */
    public function getUserSchedules(User $user) {
        $scheduleNamesAndIds = [];
        $userSchedules = $this->em->getRepository(UserMealsSchedules::class)
            ->findBy(['user' => $user->getId()]);

        foreach($userSchedules as $schedule) {
            $scheduleNamesAndIds[] =
                [
                    'id' => $schedule->getId(),
                    'name' => $schedule->getName()
                ];
        }

        return $scheduleNamesAndIds;
    }


}