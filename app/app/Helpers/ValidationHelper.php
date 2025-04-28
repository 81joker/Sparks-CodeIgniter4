<?php

namespace App\Helpers;

class ValidationHelper
{
    public function ValidationRules($existingEmail = null, $context = 'user') 
    {
        $emailRule = 'required|valid_email';
        if ($existingEmail) {
            $emailRule .= '|is_unique[persons.email,email,' . $existingEmail . ']';
        } else {
            $emailRule .= '|is_unique[persons.email]';
        }

        $rules = [
            'firstname' => [
                'rules' => 'required|min_length[2]|max_length[50]',
                'errors' => [
                    'required' => 'Das Feld Vorname ist erforderlich.',
                    'min_length' => 'Der Vorname muss mindestens 2 Zeichen lang sein.',
                    'max_length' => 'Der Vorname darf nicht länger als 50 Zeichen sein.'
                ]
            ],
            'lastname' => [
                'rules' => 'required|min_length[2]|max_length[50]',
                'errors' => [
                    'required' => 'Das Feld Nachname ist erforderlich.',
                    'min_length' => 'Der Nachname muss mindestens 2 Zeichen lang sein.',
                    'max_length' => 'Der Nachname darf nicht länger als 50 Zeichen sein.'
                ]
            ],
            'email' => [
                'rules' => $emailRule,
                'errors' => [
                    'required' => 'Das Feld E-Mail ist erforderlich.',
                    'valid_email' => 'Bitte geben Sie eine gültige E-Mail-Adresse ein.',
                    'is_unique' => 'Die E-Mail-Adresse muss eindeutig sein.'
                ]
            ],
            'phone' => [
                'rules' => 'required|regex_match[/^\+?\d{1,3}?[\s\-]?\(?\d{2,4}\)?[\s\-]?\d{2,4}[\s\-]?\d{2,4}$/]',
                'errors' => [
                    'required' => 'Das Feld Telefonnummer ist erforderlich.',
                    'regex_match' => 'Bitte geben Sie eine gültige Telefonnummer im Format wie +1 (555) 506-5535 ein.'
                ]
            ],
            'avatar' => [
                // "rules" => "uploaded[avatar]|max_size[avatar,1024]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/gif,image/png]",
                "rules" => "if_exist|max_size[avatar,1024]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/gif,image/png]",

                'errors' => [
                    'max_size' => 'Avatar-Bild darf nicht größer als 1MB sein.',
                    'is_image' => 'Nur Bilddateien (jpg, png, gif) sind erlaubt.'
                ]
            ]
        ];

        if ($context === 'user') {
            $rules['role'] = [
                'rules' => 'required|in_list[admin,instructor]',
                'errors' => [
                    'required' => 'Das Feld Rolle ist erforderlich.',
                    'in_list' => 'Die Rolle muss entweder "admin" oder "instructor" sein.'
                ]
            ];
        } elseif ($context === 'customer') {
            $rules['type'] = [
                'rules' => 'required|in_list[parent,child]',
                'errors' => [
                    'required' => 'Das Feld Typ ist erforderlich.',
                    'in_list' => 'Der Typ muss entweder "parent" oder "child" sein.'
                ]
            ];
        }  elseif ($context === 'login') {
            $rules = [
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Email is required',
                        'valid_email' => 'Please enter a valid email address'
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[8]',
                    'errors' => [
                        'required' => 'Password is required',
                        'min_length' => 'Password must be at least 8 characters long'
                    ]
                ]
            ];
        } 
        
        elseif ($context === 'product') {
            $rules = [
                'name' => [
                    'rules' => 'required|min_length[2]|max_length[50]',
                    'errors' => [
                        'required' => 'Das Feld Name Product ist erforderlich.',
                        'min_length' => 'Der Name Product muss mindestens 2 Zeichen lang sein.',
                        'max_length' => 'Der Name Product darf nicht länger als 50 Zeichen sein.'
                    ]
                ],
                'description' => [
                    'rules' => 'required|min_length[2]|max_length[1000]',
                    'errors' => [
                        'required' => 'Das Feld Description Product ist erforderlich.',
                        'min_length' => 'Der Description Product muss mindestens 2 Zeichen lang sein.',
                        'max_length' => 'Der Description Product darf nicht länger als 50 Zeichen sein.'
                    ]
                ],
                'price' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Das Feld Price Product ist erforderlich.',
                        'numeric' => 'Der Price Product muss eine Zahl sein.'
                    ]
                ],
                'image' => [
                    'rules' => 'if_exist|max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/gif,image/png]',
                    'errors' => [
                        'max_size' => 'Avatar-Bild darf nicht größer als 1MB sein.',
                        'is_image' => 'Nur Bilddateien (jpg, png, gif) sind erlaubt.'
                    ]
                ]
            ];
        } 

        return $rules;
    }
}
