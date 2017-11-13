# Job Board Manager


**Job Board Manager** plugin created for manage job site easily. it allows you to create job board manager website within few minute without any complex setup, it has the different shortcode for displaying job archive, job submission, account, logged in user job list and more. job single page is optimized for SEO by following schema.org markup. this plugin has the variety of action and filter hook to extend functionality as needed.


### Job Board Manager by [http://pickplugins.com](http://pickplugins.com)

* [Live Demo](http://www.pickplugins.com/demo/job-board-manager/)
* [Add-on Bundle](http://www.pickplugins.com/item/job-board-manager-create-job-site-for-wordpress/)
* [Documentation](http://www.pickplugins.com/documentation/job-board-manager/)

##Video tutorial

* [How to Install and Settings](https://www.youtube.com/watch?v=avfOO82Kz2g)
* [Create a job](https://www.youtube.com/watch?v=KZygrlmNrE8)


## Ready Add-on

**Free**

* [Locations](https://wordpress.org/plugins/job-board-manager-locations/)
* [Company Profile](https://wordpress.org/plugins/job-board-manager-company-profile/)
* [Expired Check](https://wordpress.org/plugins/job-board-manager-expired-check/)
* [Widgets](https://wordpress.org/plugins/job-board-manager-widgets/)
* [Breadcrumb](https://wordpress.org/plugins/job-board-manager-breadcrumb/)


**Premium**

* [Job Alerts](http://www.pickplugins.com/item/job-board-manager-saved-jobs/)
* [Saved Jobs](https://www.pickplugins.com/item/job-board-manager-job-alerts/)
* [Application Manager](http://www.pickplugins.com/item/job-board-manager-application-manager/)
* [WooCommerce Paid Listing](http://www.pickplugins.com/item/job-board-manager-woocommerce-paid-listing/)
* [Stats](http://www.pickplugins.com/item/job-board-manager-stats/)
* [Job List Ads](http://www.pickplugins.com/item/job-board-manager-job-list-ads/)
* [Search & Filter](http://www.pickplugins.com/item/job-board-manager-search/)
* [Job Feed](http://www.pickplugins.com/item/job-board-manager-job-feed/)
* [Report Job](http://www.pickplugins.com/item/job-board-manager-report-job/)


# Plugin Features

* schema.org support.
* Job list with pagination support via short-codes.
* Job single page.
* Extensible supported setting page by filter hook.
* reCAPTCHA for job submission form.
* Notification email for new job posted, published.
* Extensible supported job meta input by filter hook.
* Front-End job submission form via short-codes
* Featured job marker.

**Job List page**

Use following short-code to display job archive with pagination.
`
[job_list]
`

**Front-End Job submit form**

Use following short-code to display new job submission form.
`
[job_submit_form]
`


**Front-End Job edit form**

Use following short-code to display new job edit page.
`
[job_bm_job_edit]
`

**Front-End My Account form**

Use following short-code  to display new account page for login & register form.
`
[job_bm_my_account]
`

**Client job list**

Display list of jobs posted by logged in clients/employer by using following short-code.
`
[client_job_list]
`



**Filters job type**

you can add your job type by filter hook as following example bellow.

`
function job_bm_filters_job_type_extra($job_type){
	
	$job_type_new = array('job_type_1'=>'Job Type 1','job_type_2'=>'Job Type 2');
	$job_type = array_merge($job_type,$job_type_new);
	
	return $job_type;
		
	}
add_filter('job_bm_filters_job_type','job_bm_filters_job_type_extra');
`

**Filters salary type**

you can add your salary type by filter hook as following example bellow.

`
function job_bm_filters_salary_type_extra($salary_type){
	
	$salary_type_new = array('salary_type_1'=>'Salary Type 1','salary_type_1'=>'Salary Type 2',);
	$salary_type = array_merge($salary_type,$salary_type_new);
	
	return $salary_type;
		
	}
add_filter('job_bm_filters_salary_type','job_bm_filters_salary_type_extra');
`

**Extend meta fields**

If you need some extra input fields under job post type you can use filter hook as following, currently support input fileds are text, textarea, radio, select, checkbox, multi-text,

Please see the file <strong>includes/class-post-meta.php</strong> for example option input by array. 

`
function job_bm_filter_job_input_fields_extra($input_fields){
    

	$meta_fields = $input_fields['meta_fields'];
	
	// Add new fields in company tab , default meta group is company_info, job_info, salary_info, application
	
	$company_info = $meta_fields['company_info']['meta_fields'];

    $company_field_extra[] = array(
									'meta_key'=>'job_bm_company_extra',
									'css_class'=>'company_extra',
									'placeholder'=>__('Write Company Name Extra.',job_bm_textdomain),					
									'title'=>__('Company Extra',job_bm_textdomain),
									'option_details'=>__('Company Extra, ex: Google Inc.',job_bm_textdomain),						
									'input_type'=>'text', // text, radio, checkbox, select, 
									'input_values'=>'', // could be array
									);
			
									
	$company_info = array_merge($company_info, $company_field_extra);						
	
	$input_fields['meta_fields']['company_info']['meta_fields'] = 	$company_info;

									
	return $input_fields;
        
    }

add_filter('job_bm_filter_job_input_fields','job_bm_filter_job_input_fields_extra');
`


# Translation

Plugin is translation ready , please find the 'en.po' for default transaltion file under 'languages' folder and add your own translation. you can also contribute in translation, please contact us http://www.pickplugins.com/contact/
