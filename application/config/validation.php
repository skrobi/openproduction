<?php

$config = array(
    'up' =>
    array(
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email',
            'errors' => array(
                'required'      => line('Email musi być wypełniony'),
                'valid_email'   => line('Podany email jest w niewłaściwiej formie')
            ),
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required',
            'errors' => array(
                'required' => line('Hasło jest wymagane.'),
            ),
        ),
        array(
            'field' => 'cfpassword',
            'label' => 'Password Confirmation',
            'rules' => 'required|matches[password]',
            'errors' => array(
                'required'   => line('Powtórz hasło'),
                'matches'    => line('Hasła muszą być takie same')
            )
        )
    )
);
