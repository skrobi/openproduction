<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function form_open_boot($action = '', $attributes = array(), $hidden = array())
{
   return form_open($action = '', $attributes = array(), $hidden = array());
}

function form_row_start($error = null)
{
    $z ='<div class="form-group row'; 
    if(strlen($error) > 0) 
    { 
    $z .=' error'; 
    } 
    $z.='">';  
    return $z;
}

function form_row_end()
{
    return '</div>';
}

function form_input_boot($label_text, $data = array(), $error = null, $id = '', $class = 'form-control', $extra = '')
{
    $data['class'] = 'form-control';
    $z = ''.form_label($label_text, $id, array('class' => 'col-sm-2 form-control-label')).'
            <div class="col-sm-10"><p class="form-control-static">'.form_input($data, '', $extra).'</p>';
        
    if(strlen($error) > 0) {
        $z .= '<ul><li>'.$error.'</li></ul>';
    }
    $z .= '</div>';
    
    return $z;
}

function form_select_boot($label_text, $data = array(), $error, $id ='', $class = 'form-control', $extra = '')
{
    $z = ''.form_label($label_text, $id, array('class' => 'col-sm-2 form-control-label'));
    $z .= '<div class="col-sm-10">'.form_dropdown($data, '', $selected = array(), $extra = '').'</div>';
    return $z;
}