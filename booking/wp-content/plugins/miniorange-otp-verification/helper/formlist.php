<?php

if(! defined( 'ABSPATH' )) exit;

class FormList
{
	const WP_DEFAULT 		= "WordPress Default Registration Form";
	const WC_REG_FROM		= "Woocommerce Registration Form";
	const WC_CHECKOUT_FORM 	= "Woocommerce Checkout Form";
	const WC_SOCIAL_LOGIN 	= "Woocommerce Social Login";
	const PB_DEFAULT_FORM 	= "Profile Builder Registration Form";
	const SIMPLR_FORM		= "Simplr User Registration Form Plus";
	const ULTIMATE_FORM 	= "Ultimate Member Registration Form";	
	const BP_DEFAULT_FORM 	= "BuddyPress Registration Form";
	const CRF_FORM 			= "Custom User Registration Form Builder";
	const UULTRA_FORM 		= "User Ultra Registration Form";
	const UPME_FORM			= "UserProfile Made Easy Registration Form";
	const PIE_FORM			= "PIE Registration Form";
	const CF7_FORM			= "Contact Form 7 - Contact Form";
	const NINJA_FORM		= "Ninja Forms ( Below version 3.0 )";
	const TML_FORM			= "Theme My Login Form";
	const USERPRO_FORM		= "UserPro Form";
	const GRAVITY_FORM		= "Gravity Form";
	const WP_MEMBER_FORM	= 'WP Members';
	const WP_DEFAULT_LOGIN  = 'WordPress Default Login Form';
	const ULTIMATE_MEM_PRO  = 'Ultimate Membership Pro Form';
	const CLASSIFY_REGISTER = 'Classify Theme Registration Form';
	const REALES_REGISTER 	= 'Reales WP Theme Registration Form';
	const NINJA_FORM_AJAX 	= 'Ninja Forms ( Above Version 3.0 )';
	const WP_EMEMBER 		= 'WP eMember';
	const FORMCRAFTBASIC 	= 'FormCraft Basic (Free Version)';
	const FORMCRAFTPREMIUM 	= 'FormCraft (Premium Version)';
	const WPCOMMENT 		= 'WordPress Comment Form';
	const DOCDIRECT_THEME 	= 'Doc Direct Theme by ThemoGraphics';
	const WPFORMS 			= 'WP Forms';
	const CALDERA 			= "Caldera Forms";
	//const EVENT_FORM 		= "Event Registration Form";

	public static function getFormList()
	{
		$refl = new ReflectionClass('FormList');
		return $refl->getConstants();
	}

	public static function isFormEnabled($form)
	{	
		switch ($form) 
		{
			case FormList::WP_DEFAULT:
				return DefaultWordPressRegistrationForm::isFormEnabled();	break;
			case FormList::WC_REG_FROM:
				return WooCommerceRegistrationForm::isFormEnabled(); 		break;
			case FormList::WC_CHECKOUT_FORM:
				return WooCommerceCheckOutForm::isFormEnabled();			break;
			case FormList::WC_SOCIAL_LOGIN:
				return WooCommerceSocialLoginForm::isFormEnabled();			break;
			case FormList::PB_DEFAULT_FORM:
				return ProfileBuilderRegistrationForm::isFormEnabled();		break;
			case FormList::SIMPLR_FORM:
				return SimplrRegistrationForm::isFormEnabled();				break;
			case FormList::ULTIMATE_FORM:
				return UltimateMemberRegistrationForm::isFormEnabled();		break;
			case FormList::BP_DEFAULT_FORM:
				return BuddyPressRegistrationForm::isFormEnabled(); 		break;
			case FormList::CRF_FORM:
				return RegistrationMagicForm::isFormEnabled();				break;
			case FormList::UULTRA_FORM:
				return UserUltraRegistrationForm::isFormEnabled();			break;
			case FormList::UPME_FORM:
				return UserProfileMadeEasyRegistrationForm::isFormEnabled();break;
			case FormList::PIE_FORM:
				return PieRegistrationForm::isFormEnabled();				break;
			case FormList::CF7_FORM:
				return ContactForm7::isFormEnabled();						break;
			case FormList::NINJA_FORM:
				return NinjaForm::isFormEnabled();							break;
			case FormList::TML_FORM:
				return TmlRegistrationForm::isFormEnabled();				break;
			case FormList::USERPRO_FORM:
				return UserProRegistrationForm::isFormEnabled();			break;
			case FormList::GRAVITY_FORM:
				return GravityForm::isFormEnabled();						break;
			case FormList::WP_MEMBER_FORM:
				return WpMemberForm::isFormEnabled();						break;
			case FormList::WP_DEFAULT_LOGIN:
				return WPLoginForm::isFormEnabled();						break;
			case FormList::CLASSIFY_REGISTER:
				return ClassifyRegistrationForm::isFormEnabled(); 			break;
			case FormList::REALES_REGISTER:
				return RealesWPTheme::isFormEnabled();						break;
			case FormList::NINJA_FORM_AJAX:
				return NinJaFormAjaxForm::isFormEnabled();					break;
			case FormList::WP_EMEMBER:
				return WpEmemberForm::isFormEnabled();						break;
			case FormList::FORMCRAFTBASIC:
				return FormCraftBasicForm::isFormEnabled();					break;
			case FormList::WPCOMMENT:
				return WordPressComments::isFormEnabled();					break;
			case FormList::DOCDIRECT_THEME:
				return DocDirectThemeRegistration::isFormEnabled();			break;
			case FormList::WPFORMS:
				return WPFormsPlugin::isFormEnabled(); 						break;
			case FormList::CALDERA:
				return CalderaForms::isFormEnabled(); 						break;
			//case FormList::EVENT_FORM:
			//	return EventRegistrationForm::isFormEnabled();				break;
		}
	}
}