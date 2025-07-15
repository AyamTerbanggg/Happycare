<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $teamMembers = [
            [
                'name' => 'Ajeng Hidayat B.Z',
                'position' => 'Project Manager',
                'image' => asset('img/ajeng.jpg')
                // 'description' => 'Berpengalaman 15 tahun dalam bidang kesehatan'
            ],
            [
                'name' => 'Alexander Ade Putra',
                'position' => 'System Analyst',
                'image' => asset('img/alex.jpg')
            ],
            [
                'name' => 'Devina Octacahyani',
                'position' => 'Tester',
                'image' => asset('img/depin.jpg')
            ],
            [
                'name' => 'Nuzulul Abdillah Amar',
                'position' => 'Programmer',
                'image' => asset('img/amar.jpg')
            ],
            [
                'name' => 'Indah Sandiarosa',
                'position' => 'Programmer',
                'image' => asset('img/indah.jpg')
            ],
                        [
                'name' => 'Novi Diana Ningsih',
                'position' => 'Programmer',
                'image' => asset('img/novi.jpg')
            ]
        ];

        return view('about', compact('teamMembers'));
    }
}