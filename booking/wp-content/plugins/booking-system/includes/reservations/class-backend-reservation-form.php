<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin (PRO)
* Version                 : 2.2.3
* File                    : includes/reservations/class-backend-reservation-form.php
* File Version            : 1.1.0
* Created / Last Modified : 21 April 2016
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Back end reservations PHP class.
*/

    if (!class_exists('DOPBSPBackEndReservationForm')){
        class DOPBSPBackEndReservationForm extends DOPBSPBackEndReservations{
            /*
             * Constructor
             */
            function __construct(){
            }
            
            /*
             * Reject reservation.
             * 
             * @param reservation_id (integer): reservation ID
             * @post reservation_id (integer): reservation ID
             */
            function edit($reservation_id = 0){
		global $DOT;
                global $wpdb;
                global $DOPBSP;
                
                $reservation_id = $DOT->post('id', 'int');
                $form = $DOT->post('value');
                $form = utf8_encode($form);
                $form = str_replace('\"', '"', $form);
                
                $wpdb->update($DOPBSP->tables->reservations, array('form' => $form), 
                                                             array('id' => $reservation_id));
                
                echo 'success';
                
                die();
            }
        }
    }