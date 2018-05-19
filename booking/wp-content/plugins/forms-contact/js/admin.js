var defaultTitleVisibility;

jQuery(document).ready(function () {

	jQuery(".hugeit_contact_custom_settings_dropdown_heading").on("click",function () {
		jQuery(".hugeit_contact_custom_settings_dropdown_content").toggleClass("-hidden");
		if( jQuery(".hugeit_contact_custom_settings_dropdown_heading i").hasClass("hugeicons-chevron-down") ){
			jQuery(".hugeit_contact_custom_settings_dropdown_heading i")
				.removeClass("hugeicons-chevron-down")
				.addClass("hugeicons-chevron-up");
		}else{
			jQuery(".hugeit_contact_custom_settings_dropdown_heading i")
				.removeClass("hugeicons-chevron-up")
				.addClass("hugeicons-chevron-down");
		}
	});

	if( jQuery("#hugeit_contact_user_message").length ){
		jQuery("#hugeit_contact_user_message").attr("disabled","disabled");
	}

	if( jQuery("#hugeit_contact_admin_message").length ){
		jQuery("#hugeit_contact_admin_message").attr("disabled","disabled");
	}

	/*******//////////////////Submission Scripts////////////////*********/
	//   CHECK OR UNCHECK ALL SUBMITIONS
	var check_all = "#hugeit_submission_page #hugeit_top_controls .select input[name='all']";
	jQuery(check_all).change(function(){
		if(jQuery(this).is(':checked')){
			jQuery("input[name='check_comments']").each(function(){
				jQuery(this).attr("checked","checked");
			});
		}
		else{
			jQuery("input[name='check_comments']").each(function(){
				jQuery(this).removeAttr("checked");
			});
		}
	});

	// Check READ/UNREAD
	jQuery('#hugeit_submission_page #hugeit_top_controls .controls-list .select select').change(function(){   //   alert(jQuery(this).val());
		var select_val = jQuery(this).val();
		if(select_val == "all"){    //    alert(select_val);
			jQuery("#the-comment-list tr").each(function(){
				jQuery(this).find("input[name='check_comments']").attr("checked","checked");
			});
		}
		if(select_val == "none"){
			jQuery(this).parent().find("input[name='all']").removeAttr("checked");
			jQuery("#the-comment-list tr").each(function(){
				jQuery(this).find("input[name='check_comments']").removeAttr("checked");
			});
		}else{
			jQuery("#the-comment-list tr").each(function(){
				if(jQuery(this).hasClass(select_val)){ jQuery(this).find("input[name='check_comments']").attr("checked","checked"); }
				else{ jQuery(this).find("input[name='check_comments']").removeAttr("checked"); }
			});
		}
	});

	// Delete or Mark as Spam
	jQuery('#hugeit_submission_page #hugeit_top_controls .controls-list li').click(function(e){
		var command = jQuery(this).attr("class");                 // VALUES CAN BE SPAM OR TRASH
		var marked_submitions = [];                               // THERE ARE ALL CHECKED SUBMITIONS(MESSAGES)
		var self=jQuery('#hugeit_submission_page #hugeit_top_controls .controls-list li');
		jQuery("input[name='check_comments']").each(function(){   // GETTING CHECKED SUBMITIONS
			if(jQuery(this).is(':checked')){
				marked_submitions.push(jQuery(this).val());
			}
		});
		if(marked_submitions.length > 0){                         // IF EXIST SOME CHECKED SUBMITION
			if(command == "spam"){                                 // IF CLICKED IN SPAM IMAGE
				var data = {
					action: 'hugeit_contact_action',
					task: 'moveTospamSubmitions',
					spam_submitions: marked_submitions,
					nonce:hugeit_forms_obj.nonce
				};
				var forEach = Function.prototype.call.bind( Array.prototype.forEach );
				forEach( marked_submitions, function( submition_id ) {
					function showRowActions(){
						jQuery('#comment-'+submition_id+'').hover(function(){
							jQuery(this).find('.row-actions').css('display','table-row');
						},function(){
							jQuery(this).find('.row-actions').css('display','table-row')
						});
						jQuery('#comment-'+submition_id+'').find('.row-actions').css('display','table-row');
						jQuery('#comment-'+submition_id+'').find('#huge_it_spinner_'+submition_id+' img').fadeIn();
					}
					showRowActions();
				})
				jQuery.post(ajaxurl, data, function(response) {   //    alert(response);
					if(response) {                                //    alert(reviews_for_delete);
						var forEach = Function.prototype.call.bind( Array.prototype.forEach );
						forEach( marked_submitions, function( submition_id ) {    //    alert( submition_id );
							jQuery("#comment-"+submition_id+" .row-actions .not_spam").css({"display" : ""});
							jQuery("#comment-"+submition_id+" .row-actions .spam").css({"display" : "none"});
							jQuery("#comment-"+submition_id+" .author p.spamer").css({"display" : ""});
							jQuery('#comment-'+submition_id+'').find('#huge_it_spinner_'+submition_id+' img').fadeOut();
							jQuery('#comment-'+submition_id+'').find('.row-actions').css('display','none');
							jQuery('#comment-'+submition_id+'').hover(function(){
								jQuery(this).find('.row-actions').css('display','table-row');
							},function(){
								jQuery(this).find('.row-actions').css('display','none')
							})
						});
					}
				});
			}
			else{
				if(command == "trash"){                             // IF CLICKED IN TRASH IMAGE
					jQuery( "#huge-it-contact-dialog-confirm" ).dialog({ // ALERTING ARE YOU SURE DIALOG
						dialogClass:'dialog_style56',
						draggable: false,
						resizable: false,
						height:150,
						modal: true,
						buttons: {
							"Yes": function() {      // ID USER CLICKED YES I SURE
								jQuery( this ).dialog( "close" );
								var forEach = Function.prototype.call.bind( Array.prototype.forEach );
								forEach( marked_submitions, function( submition_id ) {
									function showRowActions(){
										jQuery('#comment-'+submition_id+'').hover(function(){
											jQuery(this).find('.row-actions').css('display','table-row');
										},function(){
											jQuery(this).find('.row-actions').css('display','table-row')
										});
										jQuery('#comment-'+submition_id+'').find('.row-actions').css('display','table-row');
										jQuery('#comment-'+submition_id+'').find('#huge_it_spinner_'+submition_id+' img').fadeIn();
									}
									showRowActions();
								})
								var data = {
									action: 'hugeit_contact_action',
									task: 'deleteSubmitions',
									submitions_for_delete: marked_submitions,
									nonce:hugeit_forms_obj.nonce
								};
								jQuery.post(ajaxurl, data, function(response) {    //      alert(response);
									if(response) {
										var forEach = Function.prototype.call.bind( Array.prototype.forEach );
										forEach( marked_submitions, function( submition_id ) {
											jQuery('#comment-'+submition_id+'').fadeOut(function(){
												jQuery(this).animate({"left": "0","top":"0"});
												jQuery(this).empty();
											});
										});
									}
								});
							},
							Cancel: function() {
								jQuery( this ).dialog( "close" );
							}
						}
					});
				}
			}
		}
		if(command == "refrash"){
			e.preventDefault();
			var marked_submitions_refresh = [];
			var countTorefresh=jQuery('#hugeit_submission_page input[name="countTorefresh"]').val();
			var subID=jQuery('#hugeit_submission_page input[name="subID"]').val();
			var marked_submitions_refresh= jQuery("#hugeit_submission_page").find("input[name='check_comments']").filter(':first').val();
			jQuery.ajax({
				type: "POST",
				url:ajaxurl,
				data:{
					action: 'hugeit_contact_action',
					task: 'refreshSubmissions',
					subID: subID,
					countTorefresh:countTorefresh,
					marked_submitions:marked_submitions_refresh,
					nonce:hugeit_forms_obj.nonce
				},
				beforeSend:function(){
					self.parent().find('li img.control_list_spinner').fadeIn();
				},
				success: function(response){
					var response = jQuery.parseJSON(response);
					if(response.output){
						jQuery('input[name=countTorefresh]').val(response.countTorefresh);
						jQuery("#hugeit_submission_page table").find("tbody").prepend(response.output);
						self.parent().find('li img.control_list_spinner').fadeOut();
						setTimeout(function(){
							jQuery("#hugeit_submission_page table").find("tbody").find(".prepended").removeClass("prepended");
						},1000);
					}else{
						self.parent().find('li img.control_list_spinner').fadeOut();
					}
				}
			});
		}
	});

	//////////////Unmark As Spam Single////////////////////////
	jQuery('#hugeit_submission_page').on('click tap','.row-actions .not_spam a',function(){
		var self=jQuery(this);
		var submissionId=jQuery(this).parent().attr('value');
		jQuery.ajax({
			type: "POST",
			url:ajaxurl,
			data:{
				action: 'hugeit_contact_action',
				task: 'moveFromSpamSingleSubmition',
				submissionId: submissionId,
				nonce:hugeit_forms_obj.nonce
			},
			beforeSend:function(){
				jQuery('#comment-'+submissionId+'').hover(function(){
					self.parent().parent().css('display','table-row');
				},function(){
					self.parent().parent().css('display','table-row')
				});
				self.parent().parent().css('display','table-row');
				self.parent().parent().find('#huge_it_spinner_'+submissionId+' img').fadeIn();
			},
			success: function(response){
				if(response) {
					jQuery("#comment-"+submissionId+" .row-actions .not_spam").css({"display" : "none"});
					jQuery("#comment-"+submissionId+" .row-actions .spam").css({"display" : ""});
					jQuery("#comment-"+submissionId+" .author p.spamer").css({"display" : "none"});
					self.parent().parent().find('#huge_it_spinner_'+submissionId+' img').fadeOut();
					self.parent().parent().css('display','none');
					jQuery('#comment-'+submissionId+'').hover(function(){
						self.parent().parent().css('display','table-row');
					},function(){
						self.parent().parent().css('display','none')
					});
				}
			}
		});
	});

	//////////////Mark As Spam Single////////////////////////
	jQuery('#hugeit_submission_page').on('click tap','.row-actions .spam a',function(){
		var self=jQuery(this);
		var submissionId=jQuery(this).parent().attr('value');
		jQuery.ajax({
			type: "POST",
			url:ajaxurl,
			data:{
				action: 'hugeit_contact_action',
				task: 'moveToSpamSingleSubmition',
				submissionId: submissionId,
				nonce:hugeit_forms_obj.nonce
			},
			beforeSend:function(){
				jQuery('#comment-'+submissionId+'').hover(function(){
					self.parent().parent().css('display','table-row');
				},function(){
					self.parent().parent().css('display','table-row')
				});
				self.parent().parent().css('display','table-row');
				self.parent().parent().find('#huge_it_spinner_'+submissionId+' img').fadeIn();
			},
			success: function(response){
				if(response) {
					jQuery("#comment-"+submissionId+" .row-actions .not_spam").css({"display" : ""});
					jQuery("#comment-"+submissionId+" .row-actions .spam").css({"display" : "none"});
					jQuery("#comment-"+submissionId+" .author p.spamer").css({"display" : ""});
					self.parent().parent().find('#huge_it_spinner_'+submissionId+' img').fadeOut();
					self.parent().parent().css('display','none');
					jQuery('#comment-'+submissionId+'').hover(function(){
						self.parent().parent().css('display','table-row');
					},function(){
						self.parent().parent().css('display','none')
					})
				}
			}
		})
	})

	///////////////Mark As Spam From Message Page////////////////////////////////////////
	jQuery('#hugeit_single_submission_page #hugeit_top_controls li.spam a').click(function(){
		var self=jQuery(this);
		var submissionId=jQuery(this).parent().attr('value');
		if(self.parent().hasClass('spamed')){
			jQuery.ajax({
				type: "POST",
				url:ajaxurl,
				data:{
					action: 'hugeit_contact_action',
					task: 'moveFromSpamSingleSubmition',
					submissionId: submissionId,
					nonce:hugeit_forms_obj.nonce
				},
				beforeSend:function(){
					self.parent().parent().find('li .control_list_spinner').fadeIn();
				},
				success: function(response){
					if(response) {
						self.parent().removeClass('spamed');
						self.parent().parent().find('li .control_list_spinner').fadeOut();
					}
				}
			})
		}else{
			jQuery.ajax({
				type: "POST",
				url:ajaxurl,
				data:{
					action: 'hugeit_contact_action',
					task: 'moveToSpamSingleSubmition',
					submissionId: submissionId,
					nonce:hugeit_forms_obj.nonce
				},
				beforeSend:function(){
					self.parent().parent().find('li .control_list_spinner').fadeIn();
				},
				success: function(response){
					if(response) {
						self.parent().addClass('spamed');
						self.parent().parent().find('li .control_list_spinner').fadeOut();
					}
				}
			})
		}

	})

	/////////////Delete Single//////////////////////////
	jQuery('#hugeit_submission_page').on('click tap','.row-actions .trash a',function(){
		var self=jQuery(this);
		var submissionId=jQuery(this).parent().attr('value');
		jQuery( "#huge-it-contact-dialog-confirm" ).dialog({ // ALERTING ARE YOU SURE DIALOG
			dialogClass:'dialog_style56',
			draggable: false,
			resizable: false,
			height:150,
			modal: true,
			buttons: {
				"Yes": function() {      // ID USER CLICKED YES I SURE
					jQuery( this ).dialog( "close" );
					jQuery.ajax({
						type: "POST",
						url:ajaxurl,
						data:{
							action: 'hugeit_contact_action',
							task: 'deleteSingleSubmition',
							submissionId: submissionId,
							nonce:hugeit_forms_obj.nonce
						},
						beforeSend:function(){
							self.parent().parent().css('display','table-row');
							self.parent().parent().find('#huge_it_spinner_'+submissionId+' img').fadeIn();
						},
						success: function(response){
							if(response) {
								jQuery('#comment-'+submissionId+'').fadeOut(function(){
									jQuery(this).animate({"left": "0","top":"0"});
									jQuery(this).empty();
								});
							}
						}
					})
				},
				Cancel: function() {
					jQuery( this ).dialog( "close" );
				}
			}
		});
	})

	//////Search
	jQuery('#hugeit_submission_page > .search_block .button').click(function(e){
		e.preventDefault();
		var self=jQuery(this);
		var subID=jQuery('#hugeit_submission_page input[name="subID"]').val();
		var searchData=jQuery(this).parent().find('input[name=search_events_by_title]').val();
		if(searchData==''){
			return;
		}else{
			jQuery.ajax({
				type: "POST",
				url:ajaxurl,
				data:{
					action: 'hugeit_contact_action',
					task: 'searchSubmission',
					searchData: searchData,
					subID:subID,
					nonce:hugeit_forms_obj.nonce
				},
				beforeSend:function(){
					self.parent().parent().parent().find('.controls-list li .control_list_spinner').fadeIn();
				},
				success: function(response){
					var response = jQuery.parseJSON(response);
					if(response.output) {
						jQuery("#hugeit_submission_page table").find("tbody").html(response.output);
						self.parent().parent().parent().find('.controls-list li .control_list_spinner').fadeOut();
						self.parent().parent().parent().find('.page-navigation').css('display','none');
					}else{
						self.parent().parent().parent().find('.controls-list li .control_list_spinner').fadeOut();
						self.parent().find('input[name=search_events_by_title]').val('')
						self.parent().find('input[name=search_events_by_title]').attr('placeholder','No results found...')
					}
				}
			})
		}
	})

	/*******////////BULK ACTIONS////////*********/
	jQuery('#hugeit_submission_page #hugeit_top_controls .controls-list li a.apply').click(function(e){
		e.preventDefault();
		var _this=jQuery(this);
		var marked_submitions = [];
		var selectVal=_this.parent().parent().find('.select_actions select').val();
		jQuery("input[name='check_comments']").each(function(){   // GETTING CHECKED SUBMITIONS
			if(jQuery(this).is(':checked')){
				marked_submitions.push(jQuery(this).val());
			}
		});
		if(selectVal=='none'){
			return false;
		}else if(selectVal=='read'){
			if(marked_submitions.length > 0){
				var data = {
					action: 'hugeit_contact_action',
					task: 'markAsRead',
					read_submitions: marked_submitions,
					nonce:hugeit_forms_obj.nonce
				};
				jQuery('#hugeit_top_controls .controls-list li img.control_list_spinner').fadeIn();
				var forEach = Function.prototype.call.bind( Array.prototype.forEach );
				forEach( marked_submitions, function( submition_id ) {
					function showRowActions(){
						jQuery('#comment-'+submition_id+'').hover(function(){
							jQuery(this).find('.row-actions').css('display','table-row');
						},function(){
							jQuery(this).find('.row-actions').css('display','none')
						});
						jQuery('#comment-'+submition_id+'').find('.row-actions').css('display','table-row');
						jQuery('#comment-'+submition_id+'').find('#huge_it_spinner_'+submition_id+' img').fadeIn();
					}
					showRowActions();
				})
				jQuery.post(ajaxurl, data, function(response) {   //    alert(response);
					if(response) {                                //    alert(reviews_for_delete);
						var forEach = Function.prototype.call.bind( Array.prototype.forEach );
						forEach( marked_submitions, function( submition_id ) {    //    alert( submition_id );
							jQuery("#comment-"+submition_id).removeClass('unread');
							jQuery("#comment-"+submition_id).addClass('read');
							jQuery('#comment-'+submition_id+'').find('#huge_it_spinner_'+submition_id+' img').fadeOut();
							jQuery('#comment-'+submition_id+'').find('.row-actions').css('display','none');
							jQuery('#comment-'+submition_id+'').hover(function(){
								jQuery(this).find('.row-actions').css('display','table-row');
							},function(){
								jQuery(this).find('.row-actions').css('display','none')
							})
						});
						jQuery('#hugeit_top_controls .controls-list li img.control_list_spinner').fadeOut();
					}
				});
			}
		}else if(selectVal=='unread'){
			if(marked_submitions.length > 0){
				var data = {
					action: 'hugeit_contact_action',
					task: 'markAsUnread',
					unread_submitions: marked_submitions,
					nonce:hugeit_forms_obj.nonce
				};
				jQuery('#hugeit_top_controls .controls-list li img.control_list_spinner').fadeIn();
				var forEach = Function.prototype.call.bind( Array.prototype.forEach );
				forEach( marked_submitions, function( submition_id ) {
					function showRowActions(){
						jQuery('#comment-'+submition_id+'').hover(function(){
							jQuery(this).find('.row-actions').css('display','table-row');
						},function(){
							jQuery(this).find('.row-actions').css('display','none')
						});
						jQuery('#comment-'+submition_id+'').find('.row-actions').css('display','table-row');
						jQuery('#comment-'+submition_id+'').find('#huge_it_spinner_'+submition_id+' img').fadeIn();
					}
					showRowActions();
				})
				jQuery.post(ajaxurl, data, function(response) {   //    alert(response);
					if(response) {                                //    alert(reviews_for_delete);
						var forEach = Function.prototype.call.bind( Array.prototype.forEach );
						forEach( marked_submitions, function( submition_id ) {    //    alert( submition_id );
							jQuery("#comment-"+submition_id).removeClass('read');
							jQuery("#comment-"+submition_id).addClass('unread');

							jQuery('#comment-'+submition_id+'').find('#huge_it_spinner_'+submition_id+' img').fadeOut();
							jQuery('#comment-'+submition_id+'').find('.row-actions').css('display','none');
							jQuery('#comment-'+submition_id+'').hover(function(){
								jQuery(this).find('.row-actions').css('display','table-row');
							},function(){
								jQuery(this).find('.row-actions').css('display','none')
							})
						});
						jQuery('#hugeit_top_controls .controls-list li img.control_list_spinner').fadeOut();
					}
				});
			}
		}else if(selectVal=='spam'){
			if(marked_submitions.length > 0){
				var data = {
					action: 'hugeit_contact_action',
					task: 'moveTospamSubmitions',
					spam_submitions: marked_submitions,
					nonce:hugeit_forms_obj.nonce
				};
				jQuery('#hugeit_top_controls .controls-list li img.control_list_spinner').fadeIn();
				var forEach = Function.prototype.call.bind( Array.prototype.forEach );
				forEach( marked_submitions, function( submition_id ) {
					function showRowActions(){
						jQuery('#comment-'+submition_id+'').hover(function(){
							jQuery(this).find('.row-actions').css('display','table-row');
						},function(){
							jQuery(this).find('.row-actions').css('display','none')
						});
						jQuery('#comment-'+submition_id+'').find('.row-actions').css('display','table-row');
						jQuery('#comment-'+submition_id+'').find('#huge_it_spinner_'+submition_id+' img').fadeIn();
					}
					showRowActions();
				})
				jQuery.post(ajaxurl, data, function(response) {   //    alert(response);
					if(response) {                                //    alert(reviews_for_delete);
						var forEach = Function.prototype.call.bind( Array.prototype.forEach );
						forEach( marked_submitions, function( submition_id ) {    //    alert( submition_id );
							jQuery("#comment-"+submition_id+" .row-actions .not_spam").css({"display" : ""});
							jQuery("#comment-"+submition_id+" .row-actions .spam").css({"display" : "none"});
							jQuery("#comment-"+submition_id+" .author p.spamer").css({"display" : ""});
							jQuery('#comment-'+submition_id+'').find('#huge_it_spinner_'+submition_id+' img').fadeOut();
							jQuery('#comment-'+submition_id+'').find('.row-actions').css('display','none');
							jQuery('#comment-'+submition_id+'').hover(function(){
								jQuery(this).find('.row-actions').css('display','table-row');
							},function(){
								jQuery(this).find('.row-actions').css('display','none')
							})
						});
						jQuery('#hugeit_top_controls .controls-list li img.control_list_spinner').fadeOut();
					}
				});
			}
		}else if(selectVal=='unspam'){
			if(marked_submitions.length > 0){
				var data = {
					action: 'hugeit_contact_action',
					task: 'moveFromspamSubmitions',
					spam_submitions: marked_submitions,
					nonce:hugeit_forms_obj.nonce
				};
				jQuery('#hugeit_top_controls .controls-list li img.control_list_spinner').fadeIn();
				var forEach = Function.prototype.call.bind( Array.prototype.forEach );
				forEach( marked_submitions, function( submition_id ) {
					function showRowActions(){
						jQuery('#comment-'+submition_id+'').hover(function(){
							jQuery(this).find('.row-actions').css('display','table-row');
						},function(){
							jQuery(this).find('.row-actions').css('display','none')
						});
						jQuery('#comment-'+submition_id+'').find('.row-actions').css('display','table-row');
						jQuery('#comment-'+submition_id+'').find('#huge_it_spinner_'+submition_id+' img').fadeIn();
					}
					showRowActions();
				})
				jQuery.post(ajaxurl, data, function(response) {   //    alert(response);
					if(response) {                                //    alert(reviews_for_delete);
						var forEach = Function.prototype.call.bind( Array.prototype.forEach );
						forEach( marked_submitions, function( submition_id ) {    //    alert( submition_id );
							jQuery("#comment-"+submition_id+" .row-actions .not_spam").css({"display" : "none"});
							jQuery("#comment-"+submition_id+" .row-actions .spam").css({"display" : ""});
							jQuery("#comment-"+submition_id+" .author p.spamer").css({"display" : "none"});
							jQuery('#comment-'+submition_id+'').find('#huge_it_spinner_'+submition_id+' img').fadeOut();
							jQuery('#comment-'+submition_id+'').find('.row-actions').css('display','none');
							jQuery('#comment-'+submition_id+'').hover(function(){
								jQuery(this).find('.row-actions').css('display','table-row');
							},function(){
								jQuery(this).find('.row-actions').css('display','none')
							})
						});
						jQuery('#hugeit_top_controls .controls-list li img.control_list_spinner').fadeOut();
					}
				});
			}
		}

	})

	/*******////////BULK ACTIONS////////*********/
	/*******//////////////////Submission Scripts END////////////////*********/
	var form_clean;
	// serialize clean form
	jQuery(function() {
		form_clean = jQuery("form").serialize();
	});
	jQuery('#hg_n_btn_block').on('click','input#save-buttom',function(){
		form_clean = jQuery("form").serialize();
		form_clean=form_clean.replace(/g-recaptcha-response=([^]*?)&/g, '');
	})
	function getParameterByName(name) {
		name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
			results = regex.exec(location.search);
		return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}
	var pageCheck=getParameterByName('page');
	// compare clean and dirty form before leaving
	if(pageCheck != 'hugeit_forms_theme_options' && pageCheck != 'hugeit_forms_general_options'){
		window.onbeforeunload = function (e) {
			var form_dirty = jQuery("form").serialize();
			form_dirty=form_dirty.replace(/g-recaptcha-response=([^]*?)&/g, '');
			if(form_clean != form_dirty) {
				return 'There is unsaved form data.';
			}else{
				window.onbeforeunload = null;
			}
		}
	}
	jQuery(window).scroll(function(){
		if(jQuery('#fields-list-left').offset() !== undefined ){
			if (jQuery(this).scrollTop() > jQuery('#fields-list-left').offset().top) {
				jQuery('.fields-list > li.open').addClass('fixedStyles');

			}else{
				jQuery('.fields-list > li.open').removeClass('fixedStyles');
			}
		}

	});
	jQuery("#shortcode_toggle").toggle(function(){
		jQuery('#post-body-heading').stop().animate({height:145},500,function(){
			jQuery('#post-body-heading #shortcode_fields').fadeIn();
		});
	},function(){
		jQuery('#post-body-heading #shortcode_fields').fadeOut();
		jQuery('#post-body-heading').stop().animate({height:60},500,function(){

		});
	});

	jQuery('.icons-block input[type="radio"]').change(function(){
		jQuery(this).parents('ul').find('li.active').removeClass('active');
		jQuery(this).parents('li').addClass('active');
	});

	jQuery('input[data-slider="true"]').bind("slider:changed", function (event, data) {
		jQuery(this).parent().find('span').html(parseInt(data.value)+"%");
		jQuery(this).val(parseInt(data.value));
	});

	jQuery('#form_background').change(function(){
		if(jQuery(this).val()=='gradient'){
			jQuery('.form_first_background_color').addClass('half');
			jQuery('.form_second_background_color').addClass('half ');
			jQuery('.form_second_background_color').removeClass('none');
		}else{
			jQuery('.form_first_background_color').removeClass('half');
			jQuery('.form_second_background_color').addClass('none');
		}
	});

	jQuery('#add-fields-block ').on('click','li > ul  li.disabled',function(){
		return false;
	})



	//Open Close Functionality
	jQuery('.fields-list ').on('click tap','li > div .open-close',function(){

		var fieldWidth=jQuery('#fields-list-block').width();
		fieldWidth=fieldWidth-20;
		if(jQuery(this).parent().parent().parent().hasClass('open')){

			jQuery('.fields-list li').removeClass('open');

			jQuery('.fields-list>li').each(function(){
				jQuery(this).css('display','block')
			});
			jQuery(this).parent().parent().parent().removeClass('fixedStyles');

			jQuery('.hugeit_contact_custom_settings_main').animate({top: 0 + 'px'});
		}else {
			var height_1, height_2, height_3;
			setTimeout(function(){
				height_1 = +(jQuery('.fields-list > li.open').height());
				height_2 = +(jQuery('#hugeit-contact-preview-container').height());
				if(height_2 < height_1){
					height_3 = Math.max(height_1 - height_2, height_2 - height_1);
				} else {
					height_3 = 0;
				}
				jQuery('.hugeit_contact_custom_settings_main').animate({top:  height_3 + 'px'});
			}, 100);

            jQuery('a.add-new ').on('click',function(){
                height_4 = +(jQuery('.fields-list > li.open').height());
                jQuery('.hugeit_contact_custom_settings_main').animate({top:  height_4 - height_1 + 40 + 'px'});
            });


			jQuery('.fields-list>li').each(function(){
				jQuery(this).css('display','block')
			})
			jQuery('.fields-list li').removeClass('open');
			jQuery(this).parent().parent().parent().addClass('open');
			jQuery('.fields-list > li.open').css({'width':fieldWidth});
			jQuery('.fields-list>li').each(function(){
				if(!jQuery(this).hasClass('open')){
					jQuery(this).css('display','none')
				}
			});

			if(jQuery(window).scrollTop() > jQuery('#fields-list-left').offset().top){
				jQuery(this).parent().parent().parent().addClass('fixedStyles');
			}
			else{
				
			}
		}
		return false;
	});

	jQuery(window).resize(function(){
		jQuery('.fields-list>li').each(function(){
			var fieldWidth=jQuery('#fields-list-block').width();
			fieldWidth=fieldWidth-20;
			jQuery(this).css('width',fieldWidth)

		});
	});



	/*################MULTIPLE OPTIONS##################*/
	/*####Set Active Option###*/
	jQuery("#fields-list-block").on('click','.fields-list .field-multiple-option-list li .set-active input',function(){
		var index = jQuery(this).parent().parent().index();
		var fieldID=jQuery(this).parents(".field-multiple-option-list").attr('rel');

		/* checkbox */
		if(jQuery(this).parents('.field-multiple-option-list').hasClass('checkbox')){
			if(jQuery(this).parent().hasClass('checked')){
				jQuery(this).parent().removeClass('checked');
				jQuery('.hugeit-contact-column-block > div[rel="huge-contact-field-'+fieldID+'"] ul').find('li').eq(index).find('input[type="checkbox"]').removeAttr('checked');
			}else {
				jQuery(this).parent().addClass("checked");
				var previewcheckbox=jQuery('.hugeit-contact-column-block > div[rel="huge-contact-field-'+fieldID+'"] ul').find('li').eq(index).find('input[type="checkbox"]');
				previewcheckbox.attr('checked','checked');
			}

			var allchecks='';
			jQuery(this).parents(".field-multiple-option-list").find('.set-active.checked input[type="radio"]').each(function(){
				allchecks+=jQuery(this).val()+";;";
			});
			allchecks=allchecks.slice(0,-2);
			jQuery(this).parents(".field-multiple-option-list").find('.field-multiple-option-active-field').val(allchecks);
		}
		/*selectbox*/
		else if(jQuery(this).parents('.field-multiple-option-list').hasClass('selectbox')){
            jQuery(this).parents(".field-multiple-option-list").find(".set-active.checked").removeClass('checked');
            jQuery(this).parent().addClass("checked");

            jQuery(this).parents(".field-multiple-option-list").siblings('.field-multiple-option-active-field').val(index);

            jQuery('.hugeit-contact-column-block > div[rel="huge-contact-field-'+fieldID+'"] select').find('option').removeAttr('selected');
            var previewselect = jQuery('.hugeit-contact-column-block > div[rel="huge-contact-field-'+fieldID+'"] select');
            previewselect.find('option.placeholder-option').remove();

            var previewSelectOption=previewselect.find('option').eq(index);
            previewSelectOption.attr('selected','selected');

            jQuery('.hugeit-contact-column-block > div[rel="huge-contact-field-'+fieldID+'"] .textholder').val( previewselect.val() );

            jQuery('#def_value'+fieldID).val('');
		}
		/* radio */
		else {
			jQuery(this).parents(".field-multiple-option-list").find(".set-active.checked").removeClass('checked');
			jQuery(this).parent().addClass("checked");

			jQuery(this).parents(".field-multiple-option-list").find('.field-multiple-option-active-field').val(index);


			jQuery('.hugeit-contact-column-block > div[rel="huge-contact-field-'+fieldID+'"] ul').find('li input[type="radio"]').removeAttr('checked');
			var previewradio=jQuery('.hugeit-contact-column-block > div[rel="huge-contact-field-'+fieldID+'"] ul').find('li').eq(index).find('input[type="radio"]');
			previewradio.attr('checked','checked');
		}
	});


	/*####Change Existing Option###*/
	jQuery("#fields-list-block").on('keypress keyup change','.fields-list .field-multiple-option-list li input:text',function(){
		if(!jQuery(this).hasClass('add-new-name')){
			var index=jQuery(this).parent().index();
			var fieldID=jQuery(this).parents(".field-multiple-option-list").attr('rel');
			var valToChange=jQuery(this).val();

			if(jQuery(this).parents('.field-multiple-option-list').hasClass('selectbox')){
				jQuery('.hugeit-contact-column-block > div[rel="huge-contact-field-'+fieldID+'"] select').find('option').eq(index).html(jQuery(this).val());
				if(index==jQuery(this).parents(".field-multiple-option-list").find('.field-multiple-option-active-field').val()){
					jQuery('.hugeit-contact-column-block > div[rel="huge-contact-field-'+fieldID+'"] .textholder').val(valToChange);
				}
			}else{
				jQuery('.hugeit-contact-column-block > div[rel="huge-contact-field-'+fieldID+'"] ul').find('li').eq(index).find('.sublable').html(jQuery(this).val());
			}
			var allvalues='';
			jQuery(this).parents(".field-multiple-option-list").find('.field-multiple-option').each(function(){
				allvalues+=jQuery(this).val()+";;";
			});
			allvalues=allvalues.slice(0,-2);
			jQuery(this).parents(".field-multiple-option-list").find('.field-multiple-option-all-values').val(allvalues);
		}
	});

	/*####ADD NEW FIELD OPTION###*/
	jQuery("#fields-list-block").on('click','.fields-list .field-multiple-option-list li .add-new',function(){

		var fieldID=jQuery(this).parents(".field-multiple-option-list").attr('rel');

		var value=jQuery(this).parent().find('.add-new-name').val();


		if(jQuery(this).parents(".field-multiple-option-list").hasClass('selectbox')){
			var previewselect=jQuery('.hugeit-contact-column-block > div[rel="huge-contact-field-'+fieldID+'"] select');
			previewselect.append('<option>'+value+'</options>');
		}
		else {
			var width=100/parseInt(jQuery(this).parents('.fields-options').find('.field-columns-count').val())+"%";

			var previewradio = jQuery('.hugeit-contact-column-block > div[rel="huge-contact-field-' + fieldID + '"]').find('.field-block input').last();
			var radiocont = previewradio.parent().html().replace('checked="checked"', '');
			var inputclass = "";
			if (previewradio.is(':checkbox')) {
				inputclass = "checkbox-block";
				previewradio.parent().parent().parent().after('<li style="width:' + width + ';"><label class="secondary-label"><div class="' + inputclass + '">' + radiocont + '</div><span class="sublable">' + value + '</span></label></li>');
			}
			else {
				inputclass = "radio-block big";
				previewradio.parent().parent().parent().after('<li style="width:' + width + ';"><label class="secondary-label"><div class="' + inputclass + '">' + radiocont + '</div><span class="sublable">' + value + '</span></label></li>');
			}
		}


		jQuery(this).parent().before('<li><input class="field-multiple-option" type="text" name="fieldoption' + fieldID + '" value="' + value + '" /><div class="set-active"><input type="radio" name="options_active_' + fieldID + '" value="' + value + '" /></div><a href="#remove" class="remove-field-option">remove</a></li>');
		var allvalues = '';
		jQuery(this).parents(".field-multiple-option-list").find('.field-multiple-option').each(function() {
			allvalues += jQuery(this).val() + ";;";
		});
		allvalues = allvalues.slice(0, -2);
		jQuery(this).parents(".field-multiple-option-list").find('.field-multiple-option-all-values').val(allvalues);
		jQuery(this).parent().find('.add-new-name').val('');
		return false;
	});


	/*####Remove Field Option###*/
	jQuery("#fields-list-block").on('click', '.fields-list .field-multiple-option-list li .remove-field-option', function() {
		var elemCount = jQuery(this).parent().parent().contents().filter(function() {
			return this.nodeName === 'LI';
		}).length;
		if (elemCount != 2) {
            var $top = jQuery('.hugeit_contact_custom_settings_main').css('top');

            jQuery('.hugeit_contact_custom_settings_main').animate({top:  parseInt($top) - 30 + 'px'});

			jQuery(this).parent().find('.field-multiple-option').addClass('removeing');
			var allvalues = '';
			jQuery(this).parents(".field-multiple-option-list").find('.field-multiple-option').not('.removeing').each(function() {
				allvalues += jQuery(this).val() + ";;";
			});

			var fieldID = jQuery(this).parents(".field-multiple-option-list").attr('rel');
			var index = jQuery(this).parent().index();

			var firstval = jQuery(this).parents('.field-multiple-option-list').find('li').eq(0).find('.field-multiple-option').val();
			var secondval = jQuery(this).parents('.field-multiple-option-list').find('li').eq(1).find('.field-multiple-option').val();

			if (jQuery(this).parents('.field-multiple-option-list').hasClass('selectbox')) {
				var allowChange = 1;
				var selectVal = jQuery(this).parents('.fields-options').find('select').val();
				if (selectVal == 'formsInsideAlign') {
					allowChange = 0;
				}

				jQuery(this).parents('.field-multiple-option-list').find('li').each(function(){
					if(jQuery(this).attr('id')=='defaultSelect'){
						allowChange=0
					}
				});

				if (allowChange != 0) {
					if (index == jQuery(this).parents(".field-multiple-option-list").find('.field-multiple-option-active-field').val()) {
						jQuery(this).parents(".field-multiple-option-list").find('.field-multiple-option-active-field').val('0');
					}
					if (jQuery(this).parent().index() == 0) {
						jQuery(this).parents('.field-multiple-option-list').find('li').eq(1).find('.set-active').addClass('checked');
						jQuery('.hugeit-contact-column-block > div[rel="huge-contact-field-' + fieldID + '"] .textholder').val(secondval);
					} else {
						jQuery(this).parents('.field-multiple-option-list').find('li').eq(0).find('.set-active').addClass('checked');
						jQuery('.hugeit-contact-column-block > div[rel="huge-contact-field-' + fieldID + '"] .textholder').val(firstval);
					}
					jQuery('.hugeit-contact-column-block > div[rel="huge-contact-field-' + fieldID + '"] select').find('option').eq(index).remove();
				}
			} else if (jQuery(this).parents('.field-multiple-option-list').hasClass('radio')) {
				if (index == jQuery(this).parents(".field-multiple-option-list").find('.field-multiple-option-active-field').val()) {
					jQuery(this).parents(".field-multiple-option-list").find('.field-multiple-option-active-field').val('0');
					jQuery('.hugeit-contact-column-block > div[rel="huge-contact-field-' + fieldID + '"] .textholder').val(firstval);
				}
				if (jQuery(this).parent().index() == 0) {
					jQuery(this).parents('.field-multiple-option-list').find('li').eq(1).find('.set-active').addClass('checked');
					var previewradio = jQuery('.hugeit-contact-column-block > div[rel="huge-contact-field-' + fieldID + '"] ul').find('li').eq(1).find('input[type="radio"]');
					previewradio.attr('checked', 'checked');
				} else {
					jQuery(this).parents('.field-multiple-option-list').find('li').eq(0).find('.set-active').addClass('checked');
					var previewradio = jQuery('.hugeit-contact-column-block > div[rel="huge-contact-field-' + fieldID + '"] ul').find('li').eq(0).find('input[type="radio"]');
					previewradio.attr('checked', 'checked');
				}
				jQuery('.hugeit-contact-column-block > div[rel="huge-contact-field-' + fieldID + '"] ul').find('li').eq(index).remove();
			} else {
				jQuery('.hugeit-contact-column-block > div[rel="huge-contact-field-' + fieldID + '"] ul').find('li').eq(index).remove();
			}
			allvalues = allvalues.slice(0, -2);
			jQuery(this).parents(".field-multiple-option-list").find('.field-multiple-option-all-values').val(allvalues);
			jQuery(this).parent().addClass("checked");
			var allowChange = 1;
			var selectVal = jQuery(this).parents('.fields-options').find('select').val();
			if (selectVal == 'formsInsideAlign') {
				allowChange = 0;
			}
			if (allowChange != 0) {
				jQuery(this).parent().remove();
			}
			return false;
		}
	});

    jQuery("#fields-list-block").on('change keyup','.fields-list li[data-fieldtype=simple_captcha_box] input[type=number],.fields-list li[data-fieldtype=simple_captcha_box] input.color',function(){
        var digits = jQuery('.fields-list li[data-fieldtype=simple_captcha_box] input[type=number]').val();
        var bgcolor = jQuery('.fields-list li[data-fieldtype=simple_captcha_box] input.color').val();
        if(digits){
            var text = '';
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for( var k = 0; k< digits; k++){
                text += possible.charAt(Math.floor(Math.random() * possible.length));
            }

            if(jQuery('.hugeit-field-block.simple-captcha-block label>img').length){
                jQuery('.hugeit-field-block.simple-captcha-block label>img').remove();
                jQuery('.hugeit-field-block.simple-captcha-block label').prepend('<div class="simple-captcha-rect" style="display:inline-block; text-align:center; line-height: 60px; font-size:30px;height:60px; width: 170px; color: #fff; background-color: #' + bgcolor + ' ">'+text+'</div>')
            } else {
                jQuery('.hugeit-field-block.simple-captcha-block label .simple-captcha-rect').text(text).css('background-color','#'+bgcolor);

            }

        }
    });



    jQuery("#fields-list-block").on('change keyup', '.fields-list .fields-options .field-columns-count', function() {
		var fieldid = jQuery(this).parents('.fields-options').parent().attr('id');
		var liwidth = 100 / parseInt(jQuery(this).val());
		jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"] ul li').css({'width': liwidth + '%'});
	});


	/*##########ONCHANGE############*/
	jQuery('.hugeit_contact_top_tabs>li').on('keyup', 'input.text_area', function() {
		var titleVal = jQuery(this).val();
		jQuery('.text_area_title').val(titleVal);
	});
	jQuery('.text_area_title').on('keyup', function() {
		var titleVal = jQuery(this).val();
		jQuery('.hugeit_contact_top_tabs input.text_area').val(titleVal);
	});
	jQuery('.hugeItTitleOverlay').click(function() {
		jQuery('.text_area_title').focus();
	});

	jQuery('#fields-list-block > ul').on({
		mouseenter: function() {
			var fieldid = jQuery(this).attr('id');
			jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"]').addClass('hover-active');
			jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"]').find('span.hugeOverlay').css('display', 'block');
		},
		mouseleave: function() {
			var fieldid = jQuery(this).attr('id');
			jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"]').removeClass('hover-active');
			jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"]').find('span.hugeOverlay').css('display', 'none');
		}
	}, "li");
	jQuery('#hugeit-contact-wrapper .hugeit-contact-column-block').on({
		mouseenter: function() {
			var fieldid = jQuery(this).attr('rel');
			jQuery(this).find('span.hugeOverlay').css('display', 'block')
			jQuery('#fields-list-block > ul > li[id="' + fieldid + '"]').addClass('border-active');
		},
		mouseleave: function() {
			var fieldid = jQuery(this).attr('rel');
			jQuery('#fields-list-block > ul > li[id="' + fieldid + '"]').removeClass('border-active');
			jQuery(this).find('span.hugeOverlay').css('display', 'none')
		}
	}, "div.hugeit-field-block");

	//Label Change Code
	jQuery('#fields-list-block').on('keyup change', 'input.label', function() {
		if (jQuery(this).parents('.fields-options').find('select#form_label_position').val() == 'formsInsideAlign') {

			var toChange = jQuery(this).parents('.fields-options').find('input.label').val();

			jQuery(this).parents('.fields-options').find('input.placeholder').attr('value', toChange);

			jQuery(this).parents('.fields-options').find('li#defaultSelect>input').attr('value', toChange);

			var fieldid = jQuery(this).parents('.fields-options').parent().attr('id');
			var previewfield = jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"] .field-block input');
			var previewfieldtextarea = jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"] .field-block textarea');
			previewfield.attr("placeholder", toChange);
			previewfield.attr("value", toChange);
			previewfieldtextarea.attr("placeholder", toChange);
			var allvalues = '';
			jQuery(this).parents(".fields-options").find('.field-multiple-option-list .field-multiple-option').each(function() {
				allvalues += jQuery(this).val() + ";;";
			});
			allvalues = allvalues.slice(0, -2);
			jQuery(this).parents(".fields-options").find('.field-multiple-option-list .field-multiple-option-all-values').val(allvalues);
		}
		var value = jQuery(this).val();
		var fieldid = jQuery(this).parents('.fields-options').parent().attr('id');
		if (value != '') {
			jQuery(this).parents('.fields-options').parent().find('h4').html(value);
		} else {
			var defLabel = jQuery(this).parents('.fields-options').parent().find('input.left-right-position').attr('fileType');
			jQuery(this).parents('.fields-options').parent().find('h4').html(defLabel);
		}
		var previewfield = jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"] label').not('.secondary-label');
		var addstar = "";
		if (previewfield.find('.required-star').length > 0) {
			addstar = '<em class="required-star">*</em>';
		}
		previewfield.html(value + addstar);
	});

	jQuery('#fields-list-block').on('keyup change', 'li#defaultSelect>input', function() {
		var toChange = jQuery(this).val();
		jQuery(this).parents('.fields-options').find('input.label').attr('value', toChange);
		jQuery(this).parents('.fields-options').parent().find('h4').html(toChange);
	});

	//Required Fields Onchange Code
	jQuery('#fields-list-block').on('keypress keyup change', '.required', function() {
		var fieldid = jQuery(this).parents('.fields-options').parent().attr('id');
        var previewfield = jQuery('.hugeit-contact-column-block > div[rel="' + fieldid +'"] ');
		var previewfield_label = previewfield.find('label').not('.secondary-label');
		var label_pos = jQuery('li#'+fieldid+' #form_label_position').val();
        var input = previewfield.find('input[type=text],input[type=number],input[type=email],textarea').not('.textholder');
        var select = previewfield.find('select');
        var inputplaceholder = input.attr('placeholder');
        var selectPlaceholder = previewfield.find('.textholder').val();
        var selectPlaceholderOption = jQuery('#'+fieldid+' .placeholder-option').val();

		if (jQuery(this).is(':checked')) {
			if(label_pos == 'formsInsideAlign'){
				if(input.length){
                    input.attr('placeholder',inputplaceholder+' *');
                } else if(select.length && selectPlaceholderOption){
                    previewfield.find('.textholder').val(selectPlaceholder+' *');
				}
			}

			previewfield_label.append('<em class="required-star">*</em>');

		} else {
            if(label_pos=='formsInsideAlign') {
                if(input.length){
                    input.attr('placeholder',inputplaceholder.replace(' *',''));
                } else if(select.length && selectPlaceholderOption){
                    previewfield.find('.textholder').val(selectPlaceholder.replace(' *',''));
                }

            }

			previewfield_label.find('.required-star').remove();
			if(previewfield.find('.textholder').length) previewfield.find('.textholder').val(selectPlaceholder.replace(' *',''));
		}
	});

	/* label position change */
	jQuery('#fields-list-block').on('keypress keyup change', 'select#form_label_position', function() {
		var fieldid = jQuery(this).parents('.fields-options').parent().attr('id');
		var fieldPosition = jQuery(this).val();
		var fieldPlaceholder = jQuery('#'+fieldid+' .placeholder').val();
		var fieldRequired = jQuery('#'+fieldid+' .required:checked').length;

		var previewField = jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"]');
		var previewFieldLabel = previewField.find('label');
		var previewFieldDiv = previewField.find('div.field-block');
		var previewFieldDivInput = previewFieldDiv.find('input[type=text],input[type=email],input[type=number],textarea').not('.textholder');

		var previewFieldDivInputPlaceholder = previewFieldDivInput.attr('placeholder');
		var previewFieldDivInputHasPlaceholder = typeof previewFieldDivInputPlaceholder !== typeof undefined && previewFieldDivInputPlaceholder !== false;

		var previewFieldSelect = previewField.find('select');
		var previewFieldSelectPlaceholder = previewField.find('.textholder');
		var previewFieldSelectPlaceholderVal = jQuery('#'+fieldid+' .placeholder-option').val();

		if(previewField.hasClass('simple-captcha-block')){
			if(previewField.hasClass('text-right')){
                previewField.removeClass('text-right').addClass('text-left');
			} else {
                previewField.removeClass('text-left').addClass('text-right');
			}
		} else {
            previewFieldDiv.removeClass('formsLeftAlign formsRightAlign formsInsideAlign formsAboveAlign');

            previewFieldLabel.attr('class',fieldPosition);
            previewFieldDiv.addClass(fieldPosition);
		}

		if( jQuery.inArray(fieldPosition, ['formsLeftAlign','formsRightAlign','formsAboveAlign']) !== -1 ){
            if(previewFieldDivInput.length)  previewFieldDivInput.attr('placeholder',fieldPlaceholder.replace(' *',''));

            if(previewFieldSelect.length && previewFieldSelectPlaceholderVal) previewFieldSelectPlaceholder.val(previewFieldSelectPlaceholderVal );
		} else if( fieldPosition == 'formsInsideAlign' && fieldRequired ){
            if(previewFieldDivInput.length) previewFieldDivInput.attr('placeholder',fieldPlaceholder + ' *');

            if(previewFieldSelect.length && previewFieldSelectPlaceholderVal) previewFieldSelectPlaceholder.val(previewFieldSelectPlaceholderVal + ' *');
		}
	});
	/* end label position change */

	/* change simple captcha color */
    jQuery('#fields-list-block').on('keypress keyup change', 'input[type=color]', function(){
        jQuery(this).siblings('input.color').val(jQuery(this).val());
    });

    jQuery('#fields-list-block').on('keypress keyup change', 'input.default-custom[type=radio]', function() {
        if(jQuery(this).val()=='default'){
            jQuery(this).closest('.input-block').find('input.custom-option').prop('disabled',true);
        }
        else{
            jQuery(this).closest('.input-block').find('input.custom-option').prop('disabled',false);
        }
    });





	jQuery('#fields-list-block').on('keypress keyup change', '.fieldisactive', function() {
            var fieldid = jQuery(this).parents('.fields-options').parent().attr('id');
            var previewfieldtextarea = jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"] textarea');
            var previewfield = jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"] .field-block input');
            if (jQuery(this).is(':checked')) {
                previewfield.removeAttr("disabled");
                previewfieldtextarea.removeAttr("disabled");
            } else {
                previewfield.attr("disabled", "disabled");
                previewfieldtextarea.attr("disabled", "disabled");
            }
	});

	/* change placeholder value */
	jQuery('#fields-list-block').on('keypress keyup change', 'input.placeholder', function() {
        var fieldid = jQuery(this).parents('.fields-options').parent().attr('id');
		var placeholder = jQuery(this).val();
		var fieldposition = jQuery('#' + fieldid +' #form_label_position').val();

		if( jQuery('#'+fieldid+' .required:checked').length && fieldposition == 'formsInsideAlign' ) placeholder = placeholder +' *';
		var previewfield = jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"] .field-block input');
		var previewfieldtextarea = jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"] .field-block textarea');
		previewfield.attr("placeholder", placeholder);
		previewfieldtextarea.attr("placeholder", placeholder);
	});

	/* change placeholder option */
    jQuery('#fields-list-block').on('keypress keyup change', 'input.placeholder-option', function() {
        var fieldid = jQuery(this).parents('.fields-options').parent().attr('data-fieldnum');
        var placeholder = jQuery(this).val();
        var _this = jQuery(this).val();
        var fieldposition = jQuery('select[name=hc_input_show_default'+fieldid+']').val();

        if(jQuery('input[name=hc_required'+fieldid+']:checked').length && fieldposition == 'formsInsideAlign') placeholder += ' *';

        if( _this ){
            if(jQuery('#hugeit_preview_textbox_'+fieldid+' option.placeholder-option').length){
                jQuery('#hugeit_preview_textbox_'+fieldid+' option.placeholder-option').text(placeholder);
            } else {
                jQuery('#hugeit_preview_textbox_'+fieldid).prepend('<option class="placeholder-option" selected="selected">'+placeholder+'</option>');
            }

            jQuery('.hugeit-field-block[rel=huge-contact-field-'+fieldid+'] .textholder').val(placeholder);
            jQuery('ul[rel='+fieldid+'] .set-active').removeClass('checked');
            jQuery('ul[rel='+fieldid+']').siblings('.field-multiple-option-active-field').val(-1);

		} else {
            jQuery('#hugeit_preview_textbox_'+fieldid+' option.placeholder-option').remove();
            var firstOption = jQuery('#hugeit_preview_textbox_'+fieldid +' option:first-child').text();
            jQuery('.hugeit-field-block[rel=huge-contact-field-'+fieldid+'] .textholder').val(firstOption);
            jQuery('ul[rel='+fieldid+'] .set-active').eq(0).addClass('checked');

            jQuery('ul[rel='+fieldid+'] .set-active').find('input[type=radio]').removeAttr('checked');
            jQuery('ul[rel='+fieldid+'] .set-active').eq(0).find('input[type=radio]').attr('checked','checked');
            jQuery('ul[rel='+fieldid+']').siblings('.field-multiple-option-active-field').val(0);

        }

    });


	jQuery('#fields-list-block').on('change keyup', '.textbox_file_type input', function() {
		var value = jQuery(this).val();
		var fieldid = jQuery(this).parents('.fields-options').parent().attr('id');
		jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"] .field-block > input').prop('type', value);

		if(value=='number'){
            jQuery('#' + fieldid + ' .hg-mask-on-check').attr('disabled',true).attr('checked', false);
		} else {
            jQuery('#' + fieldid + ' .hg-mask-on-check').attr('disabled', false);
		}
	});


	jQuery('#fields-list-block').on('change keyup', '.textarea-resize', function() {
		var fieldid = jQuery(this).parents('.fields-options').parent().attr('id');
		var textarea = jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"] textarea').not('.secondary-label');
		if (jQuery(this).is(':checked')) {
			textarea.css({'resize': 'vertical'});
		} else {
			textarea.css({'resize': 'none'});
		}
	});

	jQuery('#fields-list-block').on('change keyup', '.textarea-size', function() {
		var value = jQuery(this).val();
		var fieldid = jQuery(this).parents('.fields-options').parent().attr('id');
		var textarea = jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"] textarea');
		textarea.css({"height": value});
	});


	jQuery('#fields-list-block').on('keypress keyup', '.submitbutton', function() {
		var value = jQuery(this).val();
		var fieldid = jQuery(this).parents('.fields-options').parent().attr('id');
		var submitbutton = jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"] button[type="submit"]');
		submitbutton.html(value);
	});

	jQuery('#fields-list-block').on('keypress', '.resetbutton', function() {
		var value = jQuery(this).val();
		var fieldid = jQuery(this).parents('.fields-options').parent().attr('id');
		var resetbutton = jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"] button[type="reset"]');
		resetbutton.html(value);
	});

	jQuery('#fields-list-block').on('change keyup', '.showresetbutton', function() {
		var fieldid = jQuery(this).parents('.fields-options').parent().attr('id');
		var resetbutton = jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"] button[type="reset"]');
		if (jQuery(this).is(':checked')) {
			resetbutton.css({'display': 'inline-block'});
		} else {
			resetbutton.css({'display': 'none'});
		}
	});

	if (jQuery('select[id="form_checkbox_size"]').val() != 'go_to_url') {
		jQuery('div[id="go_to_url_field"]').hide();
	} else {
		jQuery('div[id="go_to_url_field"]').show();
	}
	jQuery('#fields-list-block').on('change', '.hugeit_contact_captcha_theme', function() {
		var position = jQuery('#fields-list-block .captcha_position').val();
		if (position == '1') {
			position = "right";
		} else {
			position = "left";
		}
		if (jQuery(this).val() == 'light') {
			jQuery('#democaptchadark').css({'display': 'none', 'float': position});
			jQuery('#democaptchalight').css({'display': 'block', 'float': position});
		} else {
			jQuery('#democaptchalight').css({'display': 'none', 'float': position});
			jQuery('#democaptchadark').css({'display': 'block', 'float': position});
		}
	});
	jQuery('#fields-list-block').on('change', '.captcha_position', function() {
		if (jQuery('#fields-list-block .hugeit_contact_captcha_theme').val() == 'light') {
			if (jQuery(this).val() == '2') {
				jQuery('#democaptchalight').css({'display': 'block', 'float': 'left'});
			} else {
				jQuery('#democaptchalight').css({'display': 'block', 'float': 'right'});
			}
		} else {
			if (jQuery(this).val() == '2') {
				jQuery('#democaptchadark').css({'display': 'block', 'float': 'left'});
			} else {
				jQuery('#democaptchadark').css({'display': 'block', 'float': 'right'});
			}
		}
	});
	jQuery('#fields-list-block').on('change', 'select[id="form_checkbox_size"]', function() {

		if (jQuery(this).val() != 'go_to_url') {
			jQuery('div[id="go_to_url_field"]').hide();
		} else {
			jQuery('div[id="go_to_url_field"]').show();
		}
	});


	//Ready to Go Onchange//
	jQuery('#fields-list-block').on('keypress keyup change', 'select#ready_form_label_position', function() {

		var fieldid = jQuery(this).parents('.fields-options').parent().attr('id');
		var currentClass = jQuery(this).val();
		var previewfield = jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"] label');
		var previewfield2 = jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"] div.field-block');
		var fieldtype = jQuery(this).parents('.fields-options').parent().find('input.left-right-position').attr('filetype');
		if (fieldtype == 'nameSurname') {
			if (previewfield2.hasClass('formsAboveAlign')) {
				previewfield2.removeClass('formsAboveAlign')
			}
			if (previewfield2.hasClass('formsLeftAlign')) {
				previewfield2.removeClass('formsLeftAlign')
			}
			if (previewfield2.hasClass('formsRightAlign')) {
				previewfield2.removeClass('formsRightAlign')
			}
			if (previewfield2.hasClass('formsLabelHide')) {
				previewfield2.removeClass('formsLabelHide')
			}
			previewfield.removeClass();
			previewfield.addClass(currentClass);
			previewfield2.addClass(currentClass);
		}
	});
	/* end label position change */

	jQuery('#fields-list-block').on('keypress keyup change', '.placeholderName', function() {

		var value = jQuery(this).val();
		var fieldid = jQuery(this).parents('.fields-options').parent().attr('id');
		var previewfield = jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"] .field-block input.pl_name');
		previewfield.attr("placeholder", value);
	});
	jQuery('#fields-list-block').on('keypress keyup change', '.placeholderSur', function() {

		var value = jQuery(this).val();
		var fieldid = jQuery(this).parents('.fields-options').parent().attr('id');
		var previewfield = jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"] .field-block input.pl_surname');
		previewfield.attr("placeholder", value);
	});
	jQuery('#fields-list-block').on('keypress keyup change', 'select.country-list', function() {

		var codeName = jQuery(this).val();
		var fieldid = jQuery(this).parents('.fields-options').parent().attr('id');
		var numCode = jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"] .field-block ul.country-list').find('li[data-country-code="' + codeName + '"]').attr('data-dial-code');
		numCode = '+' + numCode;
		var plToReplace = jQuery(this).parents('.fields-options').find('input.placeholder').val();
		plToReplace = plToReplace.replace(/(\+\d*)/, numCode)
		jQuery(this).parents('.fields-options').find('input.placeholder').val(plToReplace);
		jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"] .field-block div.selected-flag').click();
		jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"] .field-block ul.country-list').find('li[data-country-code="' + codeName + '"]').click();
	});
	jQuery('#fields-list-block').on('keypress keyup change', 'input.linkName', function() {

		var codeName = jQuery(this).val();
		var fieldid = jQuery(this).parents('.fields-options').parent().attr('id');
		jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"] .license-block').find('span.sublable a').text(codeName);
	});
	jQuery('#fields-list-block').on('keypress keyup change', 'input.linkUrl', function() {

		var url = jQuery(this).val();
		var fieldid = jQuery(this).parents('.fields-options').parent().attr('id');
		jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"] .license-block').find('span.sublable a').attr('href', url);
	});
	jQuery('#fields-list-block').on('keypress keyup change', 'textarea.fieldContent', function() {

		var fieldContent = jQuery(this).val();
		var fieldid = jQuery(this).parents('.fields-options').parent().attr('id');
		var linkName = jQuery(this).parents('.fields-options').find('input.linkName').val();
		var linkUrl = jQuery(this).parents('.fields-options').find('input.linkUrl').val();
		fieldContent = fieldContent.replace(/{link}/, '<a target="_blank" href="' + linkUrl + '">' + linkName + '</a> ');
		jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"] .license-block').find('span.sublable').html(fieldContent);
	});
	jQuery('#fields-list-block').on('keypress keyup change', 'select.fieldPos', function() {
		var position = jQuery(this).val();
		var fieldid = jQuery(this).parents('.fields-options').parent().attr('id');
		jQuery('.hugeit-contact-column-block > div[rel="' + fieldid + '"] .license-block').css('text-align', position)
	});
	//Ready to Go Onchange//
	/*edit field*/
	jQuery('#hugeit-contact-wrapper').on('click tap', '.hugeit-field-block>label', function(e) {
		e.preventDefault();
	});
	jQuery('#hugeit-contact-wrapper').on('click tap', '.hugeit-field-block', function() {
		var fieldID = jQuery(this).attr('rel');
		jQuery('#fields-list-block').find('li#' + fieldID + ' .field-top-options-block a.open-close').click();
	});
	jQuery('#hugeit-contact-wrapper').on('click tap', '.hugeit-field-block .flag-container', function() {
		return false;
	});
	/*edit field*/
	/*FRONT END PREVIEW */

	jQuery(".hugeit-contact-column-block input[type='file']").on('change keyup', function() {
		var value = jQuery(this).val().substr(jQuery(this).val().indexOf('fakepath') + 9);
		jQuery(this).parent().find('input[type="text"]').val(value);
	});

	jQuery(".hugeit-contact-column-block select").on('change keyup', function() {
		jQuery(this).prev('.textholder').val(jQuery(this).val());
	});

	jQuery.fn.ForceNumericOnly = function() {
		return this.each(function() {
			jQuery(this).keydown(function(e) {
				var key = e.charCode || e.keyCode || 0;
				// allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
				// home, end, period, and numpad decimal
				return (
				key == 8 ||
				key == 9 ||
				key == 13 ||
				key == 32 ||
				key == 46 ||
				key == 110 ||
				key == 190 ||
				(key >= 35 && key <= 40) ||
				(key >= 48 && key <= 57) ||
				(key >= 96 && key <= 105));
			});
		});
	};


	/*STYLE OPTIONS*/

	jQuery('#form_wrapper_background_type').on('change keyup', function() {

		if (jQuery(this).val() == 'gradient') {
			jQuery('.form_first_background_color').addClass('half');
			jQuery('.form_second_background_color').removeClass('none')
		} else {
			jQuery('.form_second_background_color').addClass('none');
			jQuery('.form_first_background_color').removeClass('half');
		}
	});

	jQuery('.form_background_color').on('change keyup', function() {
		var bgcolor = jQuery('.form_first_background_color').val() + ',' + jQuery('.form_second_background_color').val();
		jQuery('#form_wrapper_background_color').val(bgcolor);
	});

	jQuery('.hugeit_forms_delete_form').on('click', function() {
		var c = confirm('Are you sure you want to delete this form ?');

		if (!c) {
			return false;
		}
	});

	jQuery('.hugeit_contact_duplicate_form').on('click', function(e) {
		e.preventDefault();

		var id = jQuery(this).data('form-id'),
			nonce = jQuery(this).data('nonce');

		jQuery.ajax({
			url: ajaxurl,
			dataType: 'JSON',
			type: 'POST',
			data: {
				action: 'hugeit_contact_duplicate_form',
				nonce: nonce,
				id: id
			}
		}).done(function(response) {
			if (response.success) {
				location.reload();
			}
		})
	});


	jQuery(".close_free_banner").on("click",function(){
		jQuery(".free_version_banner").css("display","none");
		HugeitContactSetCookie( 'hgFormsFreeBannerShow', 'no', {expires:86400} );
	});
	defaultTitleVisibility = jQuery('#hugeit-contact-wrapper').find('h3').css('display');

	jQuery('#select_form_show_title').on('change', function() {
		switch (jQuery(this).val()) {
			case 'yes' :
				jQuery('#hugeit-contact-wrapper').find('h3').css('display', 'block');
				break;
			case 'no' :
				jQuery('#hugeit-contact-wrapper').find('h3').css('display', 'none');
				break;
			case 'default' :
				jQuery('#hugeit-contact-wrapper').find('h3').css('display', defaultTitleVisibility);
		}
	});

    //Reply To User
    jQuery("#reply_to_user").on("change",function () {
        if(jQuery(this).is(":checked")){
            jQuery("#form_adminstrator_user_mail").attr('readonly','readonly');
        }
        else {
            jQuery("#form_adminstrator_user_mail").removeAttr("readonly");
        }
    });
//Reply To User

    jQuery(".custom_css_save").on("click",function () {
        window.onbeforeunload=null;
    });

});

function HugeitContactSetCookie(name, value, options) {
	options = options || {};

	var expires = options.expires;

	if (typeof expires == "number" && expires) {
		var d = new Date();
		d.setTime(d.getTime() + expires * 1000);
		expires = options.expires = d;
	}
	if (expires && expires.toUTCString) {
		options.expires = expires.toUTCString();
	}


	if(typeof value == "object"){
		value = JSON.stringify(value);
	}
	value = encodeURIComponent(value);
	var updatedCookie = name + "=" + value;

	for (var propName in options) {
		updatedCookie += "; " + propName;
		var propValue = options[propName];
		if (propValue !== true) {
			updatedCookie += "=" + propValue;
		}
	}

	document.cookie = updatedCookie;
}

// drag and drop functionality //
var checkAnimate;
jQuery(function() {
	jQuery(".hugeit-contact-column-block").sortable({
		placeholder: 'ui_custom_pl',
		cancel: '',
		start: function(e, ui) {
			ui.placeholder.height(ui.item.height());
			ui.helper.find('select').addClass('openedSelect');
			ui.helper.css({'width': '90%', 'z-index': '9999'});
			if (jQuery("#fields-list-right li").length > 0) {
				checkAnimate = true;
			} else {
				var hieghtOfColumn = jQuery("#hugeit-contact-wrapper  div.hugeit-contact-block-left").height();
				var res = (hieghtOfColumn - 116) / 2;
				jQuery("#hugeit-contact-wrapper  div.hugeit-contact-block-left").animate({'width': "70%"}, 500);
				jQuery("#hugeit-contact-wrapper  div.hugeit-contact-block-right").animate({
					'width': "23%",
					'min-width': "23%"
				}, 500, function() {
					jQuery(this).css('background-position', 'center 5px')
				});
				checkAnimate = false;
			}
		},
		connectWith: ".hugeit-contact-column-block",
		stop: function(e, ui) {
			var leftelement = [];
			var rightelement = [];
			jQuery(".hugeit-contact-block-left > div").each(function() {
				leftelement.push(jQuery('.fields-list li[id="' + jQuery(this).attr('rel') + '"]'));
				jQuery(this).find('.left-right-position').val('left');
			});

			jQuery(".hugeit-contact-block-right > div").each(function() {
				rightelement.push(jQuery('.fields-list li[id="' + jQuery(this).attr('rel') + '"]'));
				jQuery(this).find('.left-right-position').val('right');
			});

			jQuery('#fields-list-left').html(leftelement);
			jQuery('#fields-list-right').html(rightelement);

			var i = 0;
			jQuery("#fields-list-right > li").each(function() {
				jQuery(this).find('.ordering').val(i);
				i++;
				if (jQuery(this).attr('data-fieldType') == 'custom_text') {
					var i, t = tinyMCE.editors;
					for (i in t) {
						if (t.hasOwnProperty(i)) {
							t[i].remove();
						}
					}
					jQuery(this).find('button.switch-html').click();
				}
			});

			var i = 0;
			jQuery("#fields-list-left > li").each(function() {
				jQuery(this).find('.ordering').val(i);
				i++;
				if (jQuery(this).attr('data-fieldType') == 'custom_text') {
					var i, t = tinyMCE.editors;
					for (i in t) {
						if (t.hasOwnProperty(i)) {
							t[i].remove();
						}
					}
					jQuery(this).find('button.switch-html').click();
				}
			});

			var j = 0;
			jQuery(".hugeit-contact-block-left > div.hugeit-field-block").each(function() {
				jQuery(this).find('input.ordering').val(j);
				j++;
			});

			var k = 0;
			jQuery(".hugeit-contact-block-right > div.hugeit-field-block").each(function() {
				jQuery(this).find('input.ordering').val(k);
				k++;
			});

			if (jQuery("#hugeit-contact-wrapper  div.hugeit-contact-block-right>div").length > 0) {
				if (jQuery("#hugeit-contact-wrapper  div.hugeit-contact-block-right>div").length == 1 && checkAnimate == false) {
					jQuery("#hugeit-contact-wrapper  div.hugeit-contact-block-left").animate({'width': "47%"}, 500);
					jQuery("#hugeit-contact-wrapper  div.hugeit-contact-block-right").animate({'width': "47%"}, 500);
				} else {
					checkAnimate = true;
				}
			} else {
				jQuery("#hugeit-contact-wrapper  div.hugeit-contact-block-left").animate({'width': "93%"}, 500);
				jQuery("#hugeit-contact-wrapper  div.hugeit-contact-block-right").animate({
					'width': "1%",
					"min-width": "1%"
				}, 500, function() {
					jQuery(this).css('background-position', 'center bottom')
				});
			}

			if (jQuery("#fields-list-right li").length > 0) {
				jQuery("#hugeit-contact-wrapper > div").addClass('multicolumn');
			} else {
				jQuery("#hugeit-contact-wrapper > div").removeClass('multicolumn');
			}
			jQuery(".fields-list > li").removeClass('has-background');
			count = jQuery(".fields-list > li").length;
			for (var i = 0; i <= count; i += 2) {
				jQuery("#fields-list-left > li").eq(i).addClass("has-background");
				jQuery("#fields-list-right > li").eq(i).addClass("has-background");
			}

		},
		over: function() {
		},
		revert: true
	});
	jQuery('.hugeit-contact-column-block').on('click', 'input', function() {
		jQuery(this).focus();
	});
	jQuery('.hugeit-contact-column-block').on('click', 'textarea', function() {
		jQuery(this).focus();
	});
	jQuery('.hugeit-contact-column-block').on('click', 'select', function() {
		if (!jQuery(this).hasClass('openedSelect')) {
			var e = document.createEvent('MouseEvents');
			e.initMouseEvent('mousedown');
			jQuery(this)[0].dispatchEvent(e);
			jQuery(this).addClass('openedSelect');

		} else {
			jQuery('body').click();
			jQuery(this).removeClass('openedSelect');
		}
		return false;
	});
});
// INLINE MENU TOGGLE FUNCTION
jQuery(document).ready(function(){
    // MOBILE ICON SHOW IN 414 WIDTH OR SMALL
jQuery( ".hg_view_plugins_block .toggle_element" ).toggle(function() {
    jQuery('.submenu').css('opacity','1');
    jQuery('.submenu').css('display','flex');
    jQuery('.submenu').css('visibility','visible');
    // jQuery('.submenu li a').css('display','inline-block');
    // jQuery('.submenu li').css('display','inline-block');


}, function() {
    jQuery('.submenu').css('visibility','hidden');


});
    var screen=jQuery(window).width();
    if (screen < 415) {
        jQuery('.huge_it_logo').addClass('hide');
        jQuery('.mobile_icon_show').removeClass('hide');
        jQuery('.mobile_icon_show').addClass('show');

    }

    jQuery(window).on("resize",function () {
        var screen=jQuery(window).width();
        if (screen < 415) {
            jQuery('.huge_it_logo').addClass('hide');
            jQuery('.mobile_icon_show').removeClass('hide');
            jQuery('.mobile_icon_show').addClass('show');

        }
    });

    // if(jQuery(window).width()<768){
    //     jQuery('.submenu').css('display','inline-block');
    // }


	/*Width of form name input*/
	if(jQuery(document).find("#huge_it_contact_formname").length){
        var _fn_width = jQuery("#huge_it_contact_formname").val().length;
        jQuery("#huge_it_contact_formname").width((_fn_width+2)*8+"px");
	}

/*Mask On*/
	(function(){
		 var def_value;
        jQuery('#fields-list-block').on("change",".hg-mask-on-check",function() {
				  var mask_on_block = jQuery(this).parent().find('.hg-mask-on');
				  def_value   = mask_on_block.closest('div.fields-options').find('.hg-def-value');
				  if(!def_value.data('val')) {
					  def_value.data('val',def_value.val());
				  }
			  else if(def_value.val()!=="" && def_value.data('val')!==def_value.val()){
					  def_value.data('val',def_value.val())
				  }
				  if(jQuery(this).is(":checked")) {
					  mask_on_block.removeClass('readonlyHgMask');
					  def_value.val('');
					  def_value.attr('readonly','readonly');
				  }
			  else {
					  jQuery(this).parent().find('.mask_on').val("");
					  mask_on_block.addClass('readonlyHgMask');
					  def_value.removeAttr('readonly');
					  def_value.val(def_value.data('val'));
				  }
			  });
		})();
/*Mask On*/

});


jQuery(document).ready(function(){
    jQuery("body").on('click', '.close_banner', function(){
        jQuery(".free_version_banner").addClass('hide');
    });
});
jQuery(document).ready(function(){
    jQuery("body").on('click', '.closer_icon_only', function(){
        jQuery(".free_version_banner").addClass('hide');
    });
});


jQuery(document).ready(function(){
    jQuery('.fixed-tabs').each(function () {
        var width = jQuery(this).find('span').width();
		jQuery(this).find('input').width(width + 35 +'px');
    })
});