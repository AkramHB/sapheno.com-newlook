<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin
* Version                 : 2.1.1
* File                    : includes/translation/class-translation-text-order.php
* File Version            : 1.0.5
* Created / Last Modified : 26 August 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Order translation text PHP class.
*/

    if (!class_exists('DOPBSPTranslationTextOrder')){
        class DOPBSPTranslationTextOrder{
            /*
             * Constructor
             */
            function __construct(){
                /*
                 * Initialize order text.
                 */
                add_filter('dopbsp_filter_translation_text', array(&$this, 'order'));
                
                /*
                 * Initialize order address text.
                 */
                add_filter('dopbsp_filter_translation_text', array(&$this, 'orderAddress'));
            }

            /*
             * Order text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function order($text){
                array_push($text, array('key' => 'PARENT_ORDER',
                                        'parent' => '',
                                        'text' => 'Order'));
                
                array_push($text, array('key' => 'ORDER_TITLE',
                                        'parent' => 'PARENT_ORDER',
                                        'text' => 'Order',
                                        'location' => 'all'));
                array_push($text, array('key' => 'ORDER_UNAVAILABLE',
                                        'parent' => 'PARENT_ORDER',
                                        'text' => 'The period you selected is not available anymore. The calendar will refresh to update the schedule.',
                                        'location' => 'all'));
                array_push($text, array('key' => 'ORDER_UNAVAILABLE_COUPON',
                                        'parent' => 'PARENT_ORDER',
                                        'text' => 'The coupon you entered is not available anymore.',
                                        'location' => 'all'));
                /*
                 * Payment methods.
                 */
                array_push($text, array('key' => 'ORDER_PAYMENT_METHOD',
                                        'parent' => 'PARENT_RESERVATIONS_RESERVATION',
                                        'text' => 'Payment method',
                                        'location' => 'all'));
                array_push($text, array('key' => 'ORDER_PAYMENT_FULL_AMOUNT',
                                        'parent' => 'PARENT_RESERVATIONS_RESERVATION',
                                        'text' => 'Pay full amount',
                                        'location' => 'all'));
                array_push($text, array('key' => 'ORDER_PAYMENT_METHOD_NONE',
                                        'parent' => 'PARENT_RESERVATIONS_RESERVATION',
                                        'text' => 'None',
                                        'location' => 'all'));
                array_push($text, array('key' => 'ORDER_PAYMENT_METHOD_ARRIVAL',
                                        'parent' => 'PARENT_RESERVATIONS_RESERVATION',
                                        'text' => 'On arrival'));
                array_push($text, array('key' => 'ORDER_PAYMENT_METHOD_WOOCOMMERCE',
                                        'parent' => 'PARENT_RESERVATIONS_RESERVATION',
                                        'text' => 'WooCommerce',
                                        'location' => 'all'));
                array_push($text, array('key' => 'ORDER_PAYMENT_METHOD_WOOCOMMERCE_ORDER_ID',
                                        'parent' => 'PARENT_RESERVATIONS_RESERVATION',
                                        'text' => 'Order ID',
                                        'location' => 'all'));
                array_push($text, array('key' => 'ORDER_PAYMENT_METHOD_TRANSACTION_ID',
                                        'parent' => 'PARENT_RESERVATIONS_RESERVATION',
                                        'text' => 'Transaction ID',
                                        'de' => 'Transaktions ID',
                                        'nl' => 'Transactie ID',
                                        'fr' => 'ID de tansaction',
                                        'pl' => 'Transaction ID',
                                        'location' => 'all'));
                /*
                 * Front end.
                 */
                array_push($text, array('key' => 'ORDER_PAYMENT_ARRIVAL',
                                        'parent' => 'PARENT_ORDER',
                                        'text' => 'Pay on arrival (need to be approved)',
                                        'de' => 'Zahlung bei ankunft (muss genehmigt werden)',
                                        'nl' => 'Betaling na bevestiging',
                                        'fr' => 'Payer à l<<single-quote>>arrivée (besoin d<<single-quote>>être approuvé)',
                                        'location' => 'all')); 
                array_push($text, array('key' => 'ORDER_PAYMENT_ARRIVAL_WITH_APPROVAL',
                                        'parent' => 'PARENT_ORDER',
                                        'text' => 'Pay on arrival (instant booking)',
                                        'nl' => 'Betaling na bevestiging (direct boeken)',
                                        'fr' => 'Payer à l<<single-quote>>arrivée (réservation instantanée)',
                                        'pl' => 'Pay on arrival (need to be approved)',
                                        'location' => 'all')); 
                array_push($text, array('key' => 'ORDER_PAYMENT_ARRIVAL_SUCCESS',
                                        'parent' => 'PARENT_ORDER',
                                        'text' => 'Your request has been successfully sent. Please wait for approval.',
                                        'de' => 'Ihre anfrage wurde erfolgreich übermittelt. Bitte warten sie auf ihre bestätigung.',
                                        'nl' => 'Uw aanvraag is succesvol verzonden. U ontvangt z.s.m. een reactie.',
                                        'fr' => 'Votre demande a bien été envoyé. Veuillez attendre l<<single-quote>>approbation.',
                                        'pl' => 'Państwa rezerwacja została wysłana, prosimy czekać na potwierdzenie.',
                                        'location' => 'all'));
                array_push($text, array('key' => 'ORDER_PAYMENT_ARRIVAL_WITH_APPROVAL_SUCCESS',
                                        'parent' => 'PARENT_ORDER',
                                        'text' => 'Your request has been successfully received. We are waiting you!',
                                        'de' => 'Wir haben ihre buchung erhalten. Wir freuen uns auf sie!',
                                        'nl' => 'Your request has been successfully received. We are waiting you!',
                                        'fr' => 'Votre demande a bien été reçue. Nous vous attendons!',
                                        'pl' => 'Państwa rezerwacja została potwierdzona, dziękujemy!',
                                        'location' => 'all'));
                
                array_push($text, array('key' => 'ORDER_TERMS_AND_CONDITIONS',
                                        'parent' => 'PARENT_ORDER',
                                        'text' => 'I accept to agree to the Terms & Conditions.',
                                        'de' => 'Ich akzeptiere die AGB.',
                                        'nl' => 'Ik accepteer de algemene voorwaarden.',
                                        'fr' => 'Je m<<single-quote>>engage à accepter les Termes & Conditions.',
                                        'pl' => 'Akceptuję regulamin.',
                                        'location' => 'all'));
                array_push($text, array('key' => 'ORDER_TERMS_AND_CONDITIONS_INVALID',
                                        'parent' => 'PARENT_ORDER',
                                        'text' => 'You must agree with our Terms & Conditions to continue.',
                                        'de' => 'Sie müssen unseren AGB zustimmen, um fortfahren zu können.',
                                        'nl' => 'U moet de algemene voorwaarden accepteren om door te gaan.',
                                        'fr' => 'Vous devez accepter nos Termes & Conditions pour continuer.',
                                        'pl' => 'Proszę zaakceptować regulamin.',
                                        'location' => 'all'));
                
                array_push($text, array('key' => 'ORDER_BOOK',
                                        'parent' => 'PARENT_ORDER',
                                        'text' => 'Book now',
                                        'de' => 'Jetzt buchen',
                                        'nl' => 'Reserveer nu',
                                        'fr' => 'Réserver maintenant',
                                        'pl' => 'Rezerwuj teraz',
                                        'location' => 'all'));
                
                return $text;
            }

            /*
             * Order address text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function orderAddress($text){
                array_push($text, array('key' => 'PARENT_ORDER_ADDRESS',
                                        'parent' => '',
                                        'text' => 'Order - Billing/shipping address'));
                
                array_push($text, array('key' => 'ORDER_ADDRESS_SELECT_PAYMENT_METHOD',
                                        'parent' => 'PARENT_ORDER_ADDRESS',
                                        'text' => 'Select payment method.',
                                        'location' => 'all'));
                array_push($text, array('key' => 'ORDER_ADDRESS_BILLING',
                                        'parent' => 'PARENT_ORDER_ADDRESS',
                                        'text' => 'Billing address',
                                        'location' => 'all'));
                array_push($text, array('key' => 'ORDER_ADDRESS_BILLING_DISABLED',
                                        'parent' => 'PARENT_ORDER_ADDRESS',
                                        'text' => 'Billing address is not enabled.',
                                        'location' => 'all'));
                array_push($text, array('key' => 'ORDER_ADDRESS_SHIPPING',
                                        'parent' => 'PARENT_ORDER_ADDRESS',
                                        'text' => 'Shipping address',
                                        'location' => 'all'));
                array_push($text, array('key' => 'ORDER_ADDRESS_SHIPPING_DISABLED',
                                        'parent' => 'PARENT_ORDER_ADDRESS',
                                        'text' => 'Shipping address is not enabled.',
                                        'location' => 'all'));
                array_push($text, array('key' => 'ORDER_ADDRESS_SHIPPING_COPY',
                                        'parent' => 'PARENT_ORDER_ADDRESS',
                                        'text' => 'Use billing address',
                                        'location' => 'all'));
                
                array_push($text, array('key' => 'ORDER_ADDRESS_FIRST_NAME',
                                        'parent' => 'PARENT_ORDER_ADDRESS',
                                        'text' => 'First name',
                                        'location' => 'all'));
                array_push($text, array('key' => 'ORDER_ADDRESS_LAST_NAME',
                                        'parent' => 'PARENT_ORDER_ADDRESS',
                                        'text' => 'Last name',
                                        'location' => 'all'));
                array_push($text, array('key' => 'ORDER_ADDRESS_COMPANY',
                                        'parent' => 'PARENT_ORDER_ADDRESS',
                                        'text' => 'Company',
                                        'location' => 'all'));
                array_push($text, array('key' => 'ORDER_ADDRESS_EMAIL',
                                        'parent' => 'PARENT_ORDER_ADDRESS',
                                        'text' => 'Email',
                                        'location' => 'all'));
                array_push($text, array('key' => 'ORDER_ADDRESS_PHONE',
                                        'parent' => 'PARENT_ORDER_ADDRESS',
                                        'text' => 'Phone number',
                                        'location' => 'all'));
                array_push($text, array('key' => 'ORDER_ADDRESS_COUNTRY',
                                        'parent' => 'PARENT_ORDER_ADDRESS',
                                        'text' => 'Country',
                                        'location' => 'all'));
                array_push($text, array('key' => 'ORDER_ADDRESS_ADDRESS_FIRST',
                                        'parent' => 'PARENT_ORDER_ADDRESS',
                                        'text' => 'Address line 1',
                                        'location' => 'all'));
                array_push($text, array('key' => 'ORDER_ADDRESS_ADDRESS_SECOND',
                                        'parent' => 'PARENT_ORDER_ADDRESS',
                                        'text' => 'Address line 2',
                                        'location' => 'all'));
                array_push($text, array('key' => 'ORDER_ADDRESS_CITY',
                                        'parent' => 'PARENT_ORDER_ADDRESS',
                                        'text' => 'City',
                                        'location' => 'all'));
                array_push($text, array('key' => 'ORDER_ADDRESS_STATE',
                                        'parent' => 'PARENT_ORDER_ADDRESS',
                                        'text' => 'State/Province',
                                        'location' => 'all'));
                array_push($text, array('key' => 'ORDER_ADDRESS_ZIP_CODE',
                                        'parent' => 'PARENT_ORDER_ADDRESS',
                                        'text' => 'Zip code',
                                        'location' => 'all'));
                
                return $text;
            }
        }
    }