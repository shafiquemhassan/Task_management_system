<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        // Create 3 demo employees
        $employees = [
            ['name' => 'Alice Johnson',  'email' => 'alice@taskmaster.com'],
            ['name' => 'Bob Smith',      'email' => 'bob@taskmaster.com'],
            ['name' => 'Carol Williams', 'email' => 'carol@taskmaster.com'],
        ];

        $users = [];
        foreach ($employees as $emp) {
            $users[] = User::create([
                'name'     => $emp['name'],
                'email'    => $emp['email'],
                'password' => Hash::make('password'),
                'role'     => 'employee',
            ]);
        }

        // Create 10 demo tasks spread across employees
        $tasks = [
            ['title' => 'Design landing page',         'description' => 'Create wireframes and mockups for the new landing page.', 'due_date' => now()->addDays(5),   'status' => 'in_progress', 'user' => $users[0]],
            ['title' => 'Write API documentation',     'description' => 'Document all REST API endpoints with examples.',            'due_date' => now()->addDays(3),   'status' => 'pending',     'user' => $users[0]],
            ['title' => 'Fix login bug',               'description' => 'Investigate and fix the session timeout issue on login.',   'due_date' => now()->subDays(1),   'status' => 'completed',   'user' => $users[0]],
            ['title' => 'Set up CI/CD pipeline',       'description' => 'Configure GitHub Actions for automated testing.',           'due_date' => now()->addDays(7),   'status' => 'pending',     'user' => $users[1]],
            ['title' => 'Database optimization',       'description' => 'Add indexes to slow queries in the reports module.',        'due_date' => now()->subDays(2),   'status' => 'in_progress', 'user' => $users[1]],
            ['title' => 'Unit tests for auth module',  'description' => 'Write PHPUnit tests covering authentication flows.',        'due_date' => now()->addDays(10),  'status' => 'pending',     'user' => $users[1]],
            ['title' => 'Update dependencies',         'description' => 'Run composer update and resolve any breaking changes.',     'due_date' => now()->subDays(3),   'status' => 'pending',     'user' => $users[1]],
            ['title' => 'User onboarding emails',      'description' => 'Set up Mailable classes for welcome and onboarding flow.',  'due_date' => now()->addDays(2),   'status' => 'in_progress', 'user' => $users[2]],
            ['title' => 'Accessibility audit',         'description' => 'Run WCAG 2.1 audit on the employee portal frontend.',      'due_date' => now()->addDays(14),  'status' => 'pending',     'user' => $users[2]],
            ['title' => 'Mobile responsive fixes',     'description' => 'Fix layout breakpoints on tablet and mobile view.',        'due_date' => now()->subDays(4),   'status' => 'completed',   'user' => $users[2]],
        ];

        foreach ($tasks as $task) {
            Task::create([
                'title'            => $task['title'],
                'description'      => $task['description'],
                'due_date'         => $task['due_date'],
                'status'           => $task['status'],
                'assigned_user_id' => $task['user']->id,
            ]);
        }
    }
}
