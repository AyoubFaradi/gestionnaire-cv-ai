<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\Experience;
use App\Models\Formation;
use App\Models\Skill;
use App\Models\JobOffer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Créer un utilisateur de test
        $user = User::create([
            'name' => 'Jean Dupont',
            'email' => 'jean.dupont@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Créer le profil de l'utilisateur
        $profile = Profile::create([
            'user_id' => $user->id,
            'title' => 'Développeur Laravel Full Stack',
            'summary' => 'Développeur passionné avec 5 ans d\'expérience en développement web et une expertise en Laravel et Vue.js.',
            'phone' => '+33 6 12 34 56 78',
            'address' => 'Paris, France',
            'linkedin' => 'https://linkedin.com/in/jeandupont',
            'github' => 'https://github.com/jeandupont',
        ]);

        // Ajouter des expériences
        $experiences = [
            [
                'poste' => 'Développeur Senior Laravel',
                'entreprise' => 'Tech Company',
                'description' => 'Développement d\'applications web complexes avec Laravel, Vue.js et PostgreSQL. Participation à l\'architecture technique et au mentoring des juniors.',
                'date_debut' => '2022-01-01',
                'date_fin' => null,
                'actuel' => true,
                'lieu' => 'Paris',
            ],
            [
                'poste' => 'Développeur Web',
                'entreprise' => 'StartUp Innovation',
                'description' => 'Création de sites web et d\'applications pour des clients variés. Utilisation de PHP, JavaScript et MySQL.',
                'date_debut' => '2020-03-01',
                'date_fin' => '2021-12-31',
                'actuel' => false,
                'lieu' => 'Lyon',
            ],
        ];

        foreach ($experiences as $exp) {
            Experience::create(array_merge(['profile_id' => $profile->id], $exp));
        }

        // Ajouter des formations
        $formations = [
            [
                'diplome' => 'Master en Informatique',
                'etablissement' => 'Université Paris-Saclay',
                'description' => 'Spécialisation en développement web et intelligence artificielle.',
                'date_debut' => '2018-09-01',
                'date_fin' => '2020-06-30',
                'actuel' => false,
                'lieu' => 'Paris',
            ],
            [
                'diplome' => 'Licence Informatique',
                'etablissement' => 'Université Claude Bernard Lyon 1',
                'description' => 'Formation générale en informatique avec focus sur le développement logiciel.',
                'date_debut' => '2015-09-01',
                'date_fin' => '2018-06-30',
                'actuel' => false,
                'lieu' => 'Lyon',
            ],
        ];

        foreach ($formations as $formation) {
            Formation::create(array_merge(['profile_id' => $profile->id], $formation));
        }

        // Ajouter des compétences
        $skills = [
            ['name' => 'Laravel', 'level' => 'expert', 'category' => 'Backend'],
            ['name' => 'PHP', 'level' => 'expert', 'category' => 'Backend'],
            ['name' => 'Vue.js', 'level' => 'avance', 'category' => 'Frontend'],
            ['name' => 'JavaScript', 'level' => 'avance', 'category' => 'Frontend'],
            ['name' => 'MySQL', 'level' => 'avance', 'category' => 'Database'],
            ['name' => 'PostgreSQL', 'level' => 'intermediaire', 'category' => 'Database'],
            ['name' => 'Docker', 'level' => 'intermediaire', 'category' => 'DevOps'],
            ['name' => 'Git', 'level' => 'expert', 'category' => 'Tools'],
            ['name' => 'API REST', 'level' => 'expert', 'category' => 'Architecture'],
            ['name' => 'TDD', 'level' => 'intermediaire', 'category' => 'Methodology'],
        ];

        foreach ($skills as $skill) {
            Skill::create(array_merge(['profile_id' => $profile->id], $skill));
        }

        // Créer des offres d'emploi de test
        $jobOffers = [
            [
                'title' => 'Développeur Laravel Senior',
                'company' => 'Digital Solutions',
                'description' => 'Nous recherchons un développeur Laravel senior pour rejoindre notre équipe technique. Vous participerez au développement de nos applications web et à l\'architecture technique.',
                'location' => 'Paris',
                'contract_type' => 'CDI',
                'salary_min' => 45000,
                'salary_max' => 65000,
                'date_limite' => '2024-02-15',
                'contact_email' => 'recrutement@digitalsolutions.fr',
                'active' => true,
            ],
            [
                'title' => 'Développeur Full Stack',
                'company' => 'Innovation Tech',
                'description' => 'Startup en pleine croissance cherche un développeur full stack passionné. Vous travaillerez sur des projets innovants utilisant les dernières technologies.',
                'location' => 'Lyon',
                'contract_type' => 'CDI',
                'salary_min' => 40000,
                'salary_max' => 55000,
                'date_limite' => '2024-01-31',
                'contact_email' => 'jobs@innovationtech.com',
                'active' => true,
            ],
            [
                'title' => 'Développeur Web Junior',
                'company' => 'Web Agency',
                'description' => 'Agence web recherche un développeur junior pour travailler sur des projets clients. Formation continue et mentorship assurés.',
                'location' => 'Marseille',
                'contract_type' => 'Stage',
                'salary_min' => 1000,
                'salary_max' => 1500,
                'date_limite' => '2024-02-28',
                'contact_email' => 'stage@webagency.fr',
                'active' => true,
            ],
        ];

        foreach ($jobOffers as $jobOffer) {
            JobOffer::create($jobOffer);
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('User: jean.dupont@example.com / Password: password123');
    }
}
