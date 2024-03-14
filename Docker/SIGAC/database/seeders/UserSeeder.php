<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    
    public function run(): void {
        
        $data = [
            [
                // ADMINISTRADOR
                "name" => "MARCUS VINÍCIUS OLIVEIRA", 
                "email" => "admin.admin@ifpr.edu.br", 
                "password" => Hash::make('123admin123'), 
                "role_id" => 1,
                "curso_id" => 1,
            ],
            [
                // COORDENADOR
                "name" => "GIL EDUARDO DE ANDRADE", 
                "email" => "gil.andrade@ifpr.edu.br", 
                "password" => Hash::make('123gil123'), 
                "role_id" => 2,
                "curso_id" => 1,
            ],
            [
                // PROFESSOR
                "name" => "ORIOSVALDO NASCIMENTO TORRES", 
                "email" => "oriosvaldo.torres@ifpr.edu.br", 
                "password" => Hash::make('123admin123'), 
                "role_id" => 1,
                "curso_id" => 1,
            ],
            [
                // ALUNO
                "name" => "LÚCIA EDUARDA SILVA ALVES", 
                "email" => "lucia.alves@gmail.com", 
                "password" => Hash::make('123lucia123'), 
                "role_id" => 4,
                "curso_id" => 2,
            ],
        ];
        DB::table('users')->insert($data);
    }
}