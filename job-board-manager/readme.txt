=== Job Board Manager ===
	Contributors: PickPlugins
	Donate link: https://www.pickplugins.com/item/job-board-manager-create-job-site-for-wordpress/?ref=wordpress.org
	Tags:  Job Board Manager, Job Board, job portal, Job, Job Poster, job manager, job, job list, job listing, Job Listings, job lists, job management, job manager,
	Requires at least: 4.1
	Tested up to: 5.1
	Stable tag: 2.0.31
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html

	Awesome Job Board Manager

== Description ==


**Job Board Manager** plugin created for manage job site easily. it allows you to create job board manager website within few minute without any complex setup, it has the different shortcode for displaying job archive, job submission, account, logged in user job list and more. job single page is optimized for SEO by following schema.org markup. this plugin has the variety of action and filter hook to extend functionality as needed.


### Job Board Manager by [http://pickplugins.com](http://pickplugins.com)

* [Live Demo](https://www.pickplugins.com/demo/job-board-manager/?ref=wordpress.org)
* [Add-on Bundle](https://www.pickplugins.com/item/job-board-manager-create-job-site-for-wordpress/?ref=wordpress.org)
* [Documentation](https://www.pickplugins.com/documentation/job-board-manager/?ref=wordpress.org)
* [Support](https://www.pickplugins.com/support/?ref=wordpress.org)


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

* [Job Alerts](https://www.pickplugins.com/product/job-board-manager-saved-jobs/)
* [Saved Jobs](https://www.pickplugins.com/product/job-board-manager-job-alerts/)
* [Application Manager](https://www.pickplugins.com/product/job-board-manager-application-manager/)
* [WooCommerce Paid Listing](https://www.pickplugins.com/product/job-board-manager-woocommerce-paid-listing/)
* [Stats](https://www.pickplugins.com/product/job-board-manager-stats/)
* [Job List Ads](https://www.pickplugins.com/product/job-board-manager-job-list-ads/)
* [Search & Filter](https://www.pickplugins.com/product/job-board-manager-search/)
* [Job Feed](https://www.pickplugins.com/product/job-board-manager-job-feed/)
* [Report Job](https://www.pickplugins.com/product/job-board-manager-report-job/)


# Plugin Features

* Schema.org support.
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



# Translation

Plugin is translation ready , please find the 'en.po' for default transaltion file under 'languages' folder and add your own translation. you can also contribute in translation, please contact us http://www.pickplugins.com/contact/


Contributors 

* [Italian, Criss Seregni](http://www.agendadelvolo.info)
* [German, Britta Skulima](http://www.deardesign.de)
* [Portuguese, Susana Araújo](http://www.epochmultimedia.com/)
* [French, Amaury Bargibant](#)

== Installation ==

1. Install as regular WordPress plugin.<br />
2. Go your plugin setting via WordPress Dashboard and find "<strong>Job Board Manager</strong>" activate it.<br />




== Screenshots ==

1. List of latest job with pagination.
2. Single job page.
3. Job submit input admin side.
4. Settings page style tab
5. Client job list
6. Front-end Job Submission form.
7. Ready addons for Job Board Manager.


== Frequently Asked Questions ==

= Single job page showing 404 error , how to solve ? =

Pelase go "Settings > Permalink Settings" and save again to reset permalink.


= Single job page style broken, what should i do ? =

you nedd to define container for single job page as come with your theme, please add following code to your theme functions.php file
`
add_action('job_bm_action_before_single_job', 'job_bm_action_before_single_job', 10);
add_action('job_bm_action_after_single_job', 'job_bm_action_after_single_job', 10);

function job_bm_action_before_single_job() {
  echo '<div class="content-wrapper ">';
}

function job_bm_action_after_single_job() {
  echo '</div>';
}
`





== Changelog ==

	= 2.0.31 =
    * 22/04/2019 - fix - settings page php error issue fixed

	= 2.0.30 =
    * 02/03/2019 - fix - small translation issue fixed.

	= 2.0.29 =
    * 13/07/2018 - fix - Content format issue fixed.

	= 2.0.28 =
    * 04/02/2018 - fix - Conflict with Yoast plugin.
    * 04/02/2018 - add - Ready for translate.wordpress.org.

	= 2.0.27 =
    * 26/11/2017 - add - added new shortcode [job_bm_dashboard]
    * 26/11/2017 - add - added new shortcode [job_bm_my_jobs]
    * 26/11/2017 - remove - remove shortcode [client_job_list] replace by  [job_bm_my_jobs]



	= 2.0.26 =
    * 14/11/2017 - update - only admin can change the job option Job status, Expiry date, Featured job.
    * 14/11/2017 - update - expiry date format update.

	= 2.0.25 =
    * 10/11/2017 - remove - remove job option "Display company name?".
    * 10/11/2017 - remove - remove job option "Display company address?".
    * 10/11/2017 - remove - remove job option "Job status".
    * 10/11/2017 - remove - remove job option "Short content".
    * 10/11/2017 - remove - remove job option "Job responsibilities".
    * 10/11/2017 - remove - remove job option "Education requirements".
    * 10/11/2017 - remove - remove job option "Experience requirements".
    * 10/11/2017 - remove - remove job option "Skills requirements".
    * 10/11/2017 - remove - remove job option "Qualifications".
    * 10/11/2017 - remove - remove job option "Expiry date".
    * 10/11/2017 - remove - remove job option "Featured job".





	= 2.0.23 =
    * 21/08/2017 - fix - single job sidebar salary currency issue fixed.

	= 2.0.22 =
    * 03/04/2017 - fix - single job sidebar info missing issue fixed.
    * 03/04/2017 - added - Search input on job archive page.	
	

	= 2.0.21 =
    * 21/12/2016 - fix - default empty logo issue on single job page.

	= 2.0.20 =
    * 13/11/2016 - add - translation file update

	= 2.0.19 =
    * 13/11/2016 - add - job view count.
    * 16/11/2016 - add - Minor php error fixed.	

	= 2.0.18 =
    * 12/11/2016 - fix - excerpt word count issue fixed.

	= 2.0.17 =
    * 12/11/2016 - update - security issue update.

	= 2.0.16 =
    * 11/11/2016 - update - security issue update.

	= 2.0.15 =
    * 21/10/2016 - update - admin editing is back.

	= 2.0.14 =
    * 06/10/2016 - add - reset eamil templates.
    * 10/10/2016 - add - redirect job preview after submit job.
    * 10/10/2016 - add - job submission type step by step and accordion.
    * 18/10/2016 - add - added FAQ on help page.
	

	= 2.0.13 =
    * 08/09/2016 - add - categories added on archive meta.
    * 08/09/2016 - fix - social share issue fixed.	
    * 08/09/2016 - add - create demo job category on plugin activation.
    * 09/09/2016 - removed - Field Editor feature removed.
    * 09/09/2016 - add - company logo upload on job submission.		


	= 2.0.12 =
    * 03/09/2016 - Fix - transaltion issue fixed.
	
	= 2.0.11 =
    * 02/09/2016 - Fix - Single job page CSS minor issue fixed.

	= 2.0.10 =
    * 01/09/2016 - add - salary range added.
	
	= 2.0.9 =
    * 10/08/2016 - add - report for custom two date.

	= 2.0.8 =
    * 27/07/2016 - add - report menu added for job stats.

	= 2.0.7 =
    * 07/07/2016 - add - default apply method "none" to hide.
	* 24/07/2016 - add - Portuguese  translation file.

	= 2.0.6 =
    * 02/07/2016 - add - Dashboard widget to display last 7 days stats.

	= 2.0.5 =
    * 01/07/2016 - add - added action on my account.
	

	= 2.0.4 =
    * 29/06/2016 - add - German translation added, by Britta Skulima.

	= 2.0.3 =
    * 29/06/2016 - add - validations only for required fields.
    * 29/06/2016 - fix - job category issue on edit page.	

	= 2.0.2 =
    * 27/06/2016 - add - Job Meta fields editor.

	= 2.0.1 =
    * 23/06/2016 - add - application can't submit on expired job.
    * 23/06/2016 - update - Client job list update UI.
    * 23/06/2016 - add - Client can delete their own jobs.	
    * 23/06/2016 - add - data validation of job submit.	
    * 23/06/2016 - add - Job edit page.
    * 23/06/2016 - add - Logged in user will Redirect to preview job after job submit.	
	* 23/06/2016 - add - new option "Can user delete jobs ?".
	* 23/06/2016 - add - new option "Can user edit jobs ?".
	* 23/06/2016 - add - Share button on single job page.	

	= 2.0.0 =
    * 30/05/2016 - add - added job categories.
    * 30/05/2016 - add - added job tags.
    * 30/05/2016 - add - added welcome page to save initial settings.	
		

	= 1.0.30 =
    * 22/04/2016 - add - Italian translation file.
	
	= 1.0.29 =
    * 22/04/2016 - update - minor update.

	= 1.0.28 =
    * 21/04/2016 - update - single job page improvement.
    * 21/04/2016 - removed - featured image for job post type removed.	

	= 1.0.27 =
    * 20/04/2016 - fix - single job width for mobile device issue fixed.

	= 1.0.26 =
    * 07/04/2016 - add - added video tutorials.
	
	= 1.0.25 =
    * 02/04/2016 - update - Minor CSS update.
    * 02/04/2016 - update - Minor PHP issue update.
    * 02/04/2016 - Remove - $ symbol removed form salary on single job sidebar.
    * 02/04/2016 - fix - featured job background color issue fixed.

	= 1.0.24 =
    * 21/03/2016 - removed - removed apply method from job post meta.
    * 21/03/2016 - add - add option apply methods for jobs.	

	= 1.0.23 =
    * 18/03/2016 - fix - Salary currency issue fixed.
	
	= 1.0.22 =
    * 17/03/2016 - fix - Featured job checkbox issue fixed.
    * 17/03/2016 - add - new filter added "job_bm_filter_file_upload_extensions".
    * 17/03/2016 - removed - option removed "Hide Admin Bar to Revoke Access".

	= 1.0.21 =
    * 12/03/2016 - fix - single job minor css issue fixed.

	= 1.0.20 =
    * 16/02/2016 - fix - Fix minor php issue.
    * 16/02/2016 - add - Added log file.	

	= 1.0.19 =
    * 11/02/2016 - add - added more fields.

	= 1.0.18 =
    * 06/02/2016 - remove - removed single job short-code.

	= 1.0.17 =
    * 03/02/2016 - update - demo company logo update.
    * 03/02/2016 - update - demo email logo update.
    * 03/02/2016 - update - Removed option "Listing Duration".       

	= 1.0.16 =
    * 02/02/2016 - add - Customize email templates.

	= 1.0.15 =
    * 02/02/2016 - add - admin UI update.

	= 1.0.13 =
    * 26/12/2015 - fix - fixed minor php issue.
    
	= 1.0.13 =
    * 18/11/2015 - add - auto display job content on job single page.
    
	= 1.0.12 =
    * 09/11/2015 - add - Excerpt display from content automatically or short content.
    * 09/11/2015 - add - Setting UI update.    

	= 1.0.11 =
    * 16/09/2015 - fix - minor php error fixed in job list.
    
	= 1.0.10 =
    * 08/09/2015 - add - sanitization for job front submission form.

	= 1.0.9 =
    * 03/09/2015 - add - option for pages.
    * 03/09/2015 - add - display job list by job type, job status, expiry date.
    
	= 1.0.8 =
    * 02/09/2015 - add - Client job list.

    
	= 1.0.7 =
    * 01/09/2015 - fix - job submission email issue fixed.
    
	= 1.0.6 =
    * 30/08/2015 - add - date picker for job submit form.
    * 30/08/2015 - add - new job status 'expired' added.
    * 30/08/2015 - add - Emails Templates for email notification.    

	= 1.0.5 =
    * 24/08/2015 - add - front-end job submit form validation check.
    
	= 1.0.4 =
    * 24/08/2015 - add - front-end job submit form.
    * 24/08/2015 - add - reCAPTCHA for job submit form.
    * 24/08/2015 - add - New Submitted Job Status.       
    
	= 1.0.3 =
    * 14/08/2015 - add - company page link to job & job list.
    
	= 1.0.2 =
    * 10/08/2015 - add - company page link to job & job list.

	= 1.0.1 =
    * 10/08/2015 - add -Menu page for addons list.
    
	= 1.0.0 =
    * 05/08/2015 Initial release.
