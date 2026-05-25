<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\AlumniProfile;
use App\Models\Event;
use App\Models\Post;
use App\Models\Comment;
use App\Models\MentorshipRelation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create a Default Admin/Test User
        $admin = User::create([
            'name' => 'Alex Mercer',
            'email' => 'alex@example.com',
            'password' => Hash::make('password'),
        ]);

        AlumniProfile::create([
            'user_id' => $admin->id,
            'graduation_year' => 2020,
            'major' => 'Computer Science & Engineering',
            'current_job_title' => 'Senior Frontend Engineer',
            'current_company' => 'Vercel',
            'skills' => 'React, Next.js, TailwindCSS, Laravel, Node.js',
            'bio' => 'Passionate about building highly interactive user interfaces and helping junior devs grow in their careers.',
            'is_mentor' => true,
            'linkedin_url' => 'https://linkedin.com/in/alex-mercer',
        ]);

        // 2. Create Mentor 1
        $mentor1 = User::create([
            'name' => 'Dr. Sarah Connor',
            'email' => 'sarah@example.com',
            'password' => Hash::make('password'),
        ]);

        AlumniProfile::create([
            'user_id' => $mentor1->id,
            'graduation_year' => 2015,
            'major' => 'Data Science & AI',
            'current_job_title' => 'Principal AI Researcher',
            'current_company' => 'OpenAI',
            'skills' => 'Python, PyTorch, Deep Learning, ML Ops, SQL',
            'bio' => 'Working at the frontier of AGI. Excited to mentor young graduates entering the field of AI and Machine Learning.',
            'is_mentor' => true,
            'linkedin_url' => 'https://linkedin.com/in/sarah-connor',
        ]);

        // 3. Create Mentor 2
        $mentor2 = User::create([
            'name' => 'Marcus Aurelius',
            'email' => 'marcus@example.com',
            'password' => Hash::make('password'),
        ]);

        AlumniProfile::create([
            'user_id' => $mentor2->id,
            'graduation_year' => 2012,
            'major' => 'Business Administration',
            'current_job_title' => 'Director of Product',
            'current_company' => 'Stripe',
            'skills' => 'Product Strategy, Roadmap Design, Growth, FinTech',
            'bio' => 'Philosopher at heart, product builder by day. Happy to discuss product management transitions and scaling business applications.',
            'is_mentor' => true,
            'linkedin_url' => 'https://linkedin.com/in/marcus-aurelius',
        ]);

        // 4. Create Mentees
        $mentee1 = User::create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
        ]);

        AlumniProfile::create([
            'user_id' => $mentee1->id,
            'graduation_year' => 2025,
            'major' => 'Software Engineering',
            'current_job_title' => 'Associate Developer',
            'current_company' => 'Github',
            'skills' => 'PHP, Ruby, Laravel, Git, CSS',
            'bio' => 'Recent graduate eager to refine my system architecture skills and build scalable web apps.',
            'is_mentor' => false,
            'linkedin_url' => 'https://linkedin.com/in/jane-doe',
        ]);

        $mentee2 = User::create([
            'name' => 'John Smith',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
        ]);

        AlumniProfile::create([
            'user_id' => $mentee2->id,
            'graduation_year' => 2024,
            'major' => 'Information Systems',
            'current_job_title' => 'Junior Business Analyst',
            'current_company' => 'Deloitte',
            'skills' => 'Excel, PowerBI, Tableau, Agile, Scrum',
            'bio' => 'Interested in transitioning into product management and learning data-driven product analytics.',
            'is_mentor' => false,
            'linkedin_url' => 'https://linkedin.com/in/john-smith',
        ]);

        // 5. Create Events
        $event1 = Event::create([
            'user_id' => $admin->id,
            'title' => 'Annual Alumni Homecoming 2026',
            'description' => 'Join us back on campus for a wonderful weekend of reminiscing, campus tours, networking, dinner, and dancing! Connect with classmates across all decades and celebrate the achievements of our alumni community. Dinner and drinks will be served.',
            'event_date' => Carbon::now()->addDays(30)->setHour(18)->setMinute(0),
            'location' => 'Main University Plaza & Grand Hall',
            'max_participants' => 300,
        ]);

        $event2 = Event::create([
            'user_id' => $mentor1->id,
            'title' => 'Tech & AI Industry Networking Mixer',
            'description' => 'An informal evening of connection and discussion for alumni working in the tech sector, specifically focusing on software engineering, product design, AI, and startup founders. Open to all students and alumni.',
            'event_date' => Carbon::now()->addDays(15)->setHour(19)->setMinute(0),
            'location' => 'Downtown Innovators Hub, Room 102',
            'max_participants' => 80,
        ]);

        $event3 = Event::create([
            'user_id' => $mentor2->id,
            'title' => 'Panel: Transitioning to Product Management',
            'description' => 'Curious about product management? Hear from four experienced alumni leaders about how they transitioned from engineering, marketing, and operations roles into Product Management. Includes a 30-minute Q&A session.',
            'event_date' => Carbon::now()->addDays(7)->setHour(17)->setMinute(30),
            'location' => 'Virtual (Zoom Meeting Link will be emailed)',
            'max_participants' => 500,
        ]);

        // RSVPs
        $event1->attendees()->attach([$admin->id, $mentor1->id, $mentor2->id, $mentee1->id, $mentee2->id], ['status' => 'registered']);
        $event2->attendees()->attach([$admin->id, $mentor1->id, $mentee1->id], ['status' => 'registered']);
        $event3->attendees()->attach([$admin->id, $mentor2->id, $mentee2->id], ['status' => 'registered']);

        // 6. Create Forum Posts
        $post1 = Post::create([
            'user_id' => $mentor1->id,
            'title' => 'Vercel is hiring Software Engineer Interns!',
            'content' => "Hey alumni network, my team at Vercel is actively seeking talented junior engineers and interns for our next cohort! If you are interested in Next.js development, performant web applications, and React, please drop a comment or DM me on LinkedIn. Happy to refer candidates who graduated within the last two years!",
            'category' => 'Careers',
        ]);

        $post2 = Post::create([
            'user_id' => $admin->id,
            'title' => 'Excited for the upcoming Homecoming event!',
            'content' => "I just RSVP'd for the Annual Alumni Homecoming next month! Who else is going? It has been almost 6 years since I graduated, and I cannot wait to see how much the campus has changed. Let's catch up and grab some coffee!",
            'category' => 'Reunions',
        ]);

        $post3 = Post::create([
            'user_id' => $mentee2->id,
            'title' => 'Advice for breaking into Product Management with an IT degree?',
            'content' => "Hi everyone! I graduated last year with a degree in Information Systems and am currently working as a Business Analyst. I want to transition into Product Management in the next 1-2 years. What courses, certifications, or internal transitions do you recommend? Thank you in advance!",
            'category' => 'Q&A',
        ]);

        // Comments
        Comment::create([
            'post_id' => $post1->id,
            'user_id' => $mentee1->id,
            'content' => 'This is an amazing opportunity, Dr. Sarah! I recently finished a Next.js project and would love to chat. I will send you a DM!',
        ]);

        Comment::create([
            'post_id' => $post1->id,
            'user_id' => $mentor1->id,
            'content' => 'Awesome, Jane! Looking forward to reviewing your application.',
        ]);

        Comment::create([
            'post_id' => $post2->id,
            'user_id' => $mentor2->id,
            'content' => 'I will be there as well, Alex! Let’s definitely meet up. It has been a long time!',
        ]);

        Comment::create([
            'post_id' => $post3->id,
            'user_id' => $mentor2->id,
            'content' => 'Hi John! I’d highly recommend reading "Inspired" by Marty Cagan and working closely with the developers in your current BA role to understand the technical constraints. Let’s connect on the mentorship tab to talk further!',
        ]);

        // 7. Create Mentorship Relationships
        MentorshipRelation::create([
            'mentor_id' => $admin->id,
            'mentee_id' => $mentee1->id,
            'status' => 'active',
            'message' => 'Hi Alex! I saw your profile and would love to learn more about frontend engineering and Laravel best practices.',
        ]);

        MentorshipRelation::create([
            'mentor_id' => $mentor2->id,
            'mentee_id' => $mentee2->id,
            'status' => 'pending',
            'message' => 'Hello Marcus! I am super interested in your product management background at Stripe and would appreciate any guidance you can offer.',
        ]);
    }
}
