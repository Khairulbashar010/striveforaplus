<?php

namespace Database\Factories;

use App\Models\TuitionPosting;
use Illuminate\Database\Eloquent\Factories\Factory;

class TuitionPostingFactory extends Factory
{
    protected $model = TuitionPosting::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'school_level_id' => $this->faker->randomElement([1, 2, 3]),
            'subject' => $this->faker->randomElement(['Mathematics', 'Science', 'English', 'History', 'Geography', 'Physics', 'Chemistry', 'Biology', 'Computer Science']),
            'fee' => $this->faker->numberBetween(100, 1000),
            'max_students' => $this->faker->numberBetween(1, 30),
            'description' => $this->faker->paragraph,
            'image' => $this->faker->randomElement(
                [
                    "https://img.freepik.com/free-photo/serious-students-focused-class-assignment_1262-15172.jpg?t=st=1739350214~exp=1739353814~hmac=19a1206f623f0058e9d0fb1fdef92bddf9cd3639b8b09d1946a56f36ea658795&w=1800", 
                    "https://img.freepik.com/free-photo/two-young-women-working-with-laptops-lying-table_1150-52102.jpg?t=st=1739350285~exp=1739353885~hmac=f7410a78df23969c8ccf077effd015297246998ac3c230a5fb08531315a35de1&w=1800", 
                    "https://img.freepik.com/free-photo/entrepreneurs-meeting-office_23-2148898686.jpg?t=st=1739350352~exp=1739353952~hmac=5bd3a554adcb5996c8bf19133dbe586b372205da82825370be261d4c8b0bd2b5&w=1800", 
                    "https://img.freepik.com/free-photo/students-process-learning_23-2147666837.jpg?t=st=1739350449~exp=1739354049~hmac=4e511ca5abdd99150b29ab9bd82e8e4554175cacac809f9ea9e62b956fa89387&w=1800", 
                    "https://img.freepik.com/free-photo/medium-shot-woman-working-from-home_23-2150232429.jpg?t=st=1739353404~exp=1739357004~hmac=4bfdf74782e07b10441154248bdf41ce348c71e81c5fdbb551248b2e243bfa4d&w=1800",
                    "https://img.freepik.com/free-photo/men-teach-women-how-work-with-laptops-work_1150-26818.jpg?t=st=1739340017~exp=1739343617~hmac=d014c77a2ce880d9b42ecdf678fa576846b548d1253b3fc85ad9565279d4b980&w=1800", 
                    "https://img.freepik.com/free-photo/smiling-working-man-woman-desk_1098-20866.jpg?t=st=1739340037~exp=1739343637~hmac=26eab3a6fe85011f9a4b12408f3f6f3b75ffc5d12e3c6438ab6ec473ef6ab035&w=1800",
                    "https://img.freepik.com/free-photo/women-read-books-men-use-laptops-search-books-libraries_1150-24666.jpg?t=st=1739340106~exp=1739343706~hmac=4f434fa59b1495fafeec6a2099ecc74d208c7e3995a0f4c83acf1be63ef2b2bf&w=1800",
                    "https://img.freepik.com/free-photo/startup-project-team-working-office-organise-company_1098-18605.jpg?t=st=1739353476~exp=1739357076~hmac=7bd2ade81d09629c423747acb360233f329b9f52f8d349165ba7f4d87112fa56&w=1800"
                ]),
        ];
    }
}