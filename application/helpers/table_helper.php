<?php

/*
 * Helper do budowania tabel. Aby wykonać tabele nalezy mieć kolumny jak i dane w tablicy
 * Options zawiera definicje kolumn. 
 * 
 * $options['column'] przyjmuje poniższe opcje
 * 'bind_name' => 'edit'
            ,'bind_type' => 'edit' lub 'data'
            ,'description' => ''
            ,'width_th' => '102'
            ,'class_th' => 'table-icon-cell'
            ,'class_th_icon' => 'font-icon font-icon-comment'
            ,'class_td' => 'table-datess'
            ,'out' => array(
                '<a href="alsdk/!ID"  rel=nofollow>opis</a> ',
                '<a href="!ID"  rel=nofollow>opis</a> '
            )
 */

if (!function_exists('table_create')) {

    function table_create($option = array(), $data = array(), $class = 'table table-bordered table-hover', $id = 'table-edit') {
        $binding_name = array();

        $table = '';
        $table .= "<table id=\"$id\" class=\"$class\">";

        $thead = '<thead>';
        $thead_tr = "<tr>";

        foreach ($option['column'] as $key) {
            $binding_name[] = $key['bind_name'];
            
            $thead_tr .= '<th ';
            if (isset($key['class_th'])) {
                $thead_tr .= 'class="'.$key['class_th'].'" ';
            } 
            if (isset($key['width_th'])) {
                $thead_tr .= 'width="' . $key['width_th'] . '" ';
            } 
            
            $thead_tr .= '>';
            
            if (isset($key['class_th_icon'])) {
                $thead_tr .= '<i class="' . $key['class_th_icon'] . '"></i>';
            }
            $thead_tr .= ' ' . $key['description'] . '</th>';
        }
        $thead_tr .= '</tr>';

        $thead_end = "</thead>";

        $thead .= $thead_tr . $thead_end;
        $table .= $thead;

        $table .= '<tbody>';

        $tr = '';
        foreach ($data as $key => $t) {
            $tr .= '<tr>';
            
            $t = (array) $t; // tablica danych przeniesiona z obiektus
            
            for ($i = 0; $i < count($option['column']); $i++) 
            {
                $tr .= "<td ";
                if(isset($option['column'][$i]['class_td'])) {
                    $tr .= ' class="'.$option['column'][$i]['class_td'].'" ';
                }
                $tr .= ">";
                if($option['column'][$i]['bind_type'] == 'data')
                {
                    $tr .= "" . $t[$binding_name[$i]] . "</td>";
                }
                elseif($option['column'][$i]['bind_type'] == 'edit')
                {
                    $z = preg_replace("/(!ID)/", $t[$option['primary_id']], $option['column'][$i]['out']);
                    $tr .= implode(" ",$z)."</td>";
                }
                 elseif($option['column'][$i]['bind_type'] == 'reg')
                {
                    $pars = new MY_Parser();
                    //var_dump($option['column'][$i]['out'], $t); die;
                    $tr .= $pars->parse_string($option['column'][$i]['out'], $t);
                }
            }

            $tr .= '</tr>';
        }
        $table .= $tr;
        $table .= '</tr>';
        $table .= '</table>';
        
        return $table;
    }

}

if (!function_exists('table_header')) {
    
    /**
     * Funkcja zwracająca nagłówek tabeli. 
     * 
     * @param strinf $title
     * @param array $icons Przyjuje tablice z wartościami jakie maja sie wyswietlic
     * @return string
     */
    function table_header($title, $icons = array())
    {
      
        $t= ' <section class="box-typical">
                <header class="box-typical-header">
                    <div class="tbl-row">
                        <div class="tbl-cell tbl-cell-title">
                            <h3>'.$title.'</h3>
                        </div>';
                        for($i=0; $i<count($icons); $i++)
                        {
                            $t .= ' <div class="tbl-cell tbl-cell-action-bordered">'
                                . '<button type="button" '.$icons[$i]['extra'].' onclick="window.location.href=\''.$icons[$i]['href'].'\'" class="action-btn">'
                                . '<i class="'.$icons[$i]['class'].'"></i></button></div>';
                        }
                       
                $t .= '</div></header>';
        
        return $t;
    }
}
