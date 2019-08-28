<?php
if ( ! defined('ABSPATH')) exit;  // if direct access

class class_get_job_data{

    public $job_id;
	
	public function __construct($jobId = 0){

	    $this->job_id = $jobId;


		}




    public function get_total_vacancies(){

        $job_id = $this->job_id;

        $total_vacancies = (int) get_post_meta($job_id, 'job_bm_total_vacancies', true);

        return $total_vacancies;


    }


    public function get_job_type(){

        $job_id = $this->job_id;

        $job_type = get_post_meta($job_id, 'job_bm_job_type', true);

        return $job_type;


    }

    public function get_job_level(){

        $job_id = $this->job_id;

        $job_level = get_post_meta($job_id, 'job_bm_job_level', true);

        return $job_level;


    }


    public function get_years_experience(){

        $job_id = $this->job_id;

        $years_experience = get_post_meta($job_id, 'job_bm_years_experience', true);

        return $years_experience;


    }


    public function get_salary_type(){

        $job_id = $this->job_id;

        $salary_type = get_post_meta($job_id, 'job_bm_salary_type', true);

        return $salary_type;


    }

    public function get_salary_fixed(){

        $job_id = $this->job_id;

        $salary_fixed = (int) get_post_meta($job_id, 'job_bm_salary_fixed', true);

        return $salary_fixed;


    }


    public function get_salary_minimum(){

        $job_id = $this->job_id;

        $salary_min = (int) get_post_meta($job_id, 'job_bm_salary_min', true);

        return $salary_min;


    }


    public function get_salary_maximum(){

        $job_id = $this->job_id;

        $salary_maximum = (int) get_post_meta($job_id, 'job_bm_salary_max', true);

        return $salary_maximum;


    }

    public function get_salary_currency(){

        $job_id = $this->job_id;

        $salary_currency = get_post_meta($job_id, 'job_bm_salary_currency', true);

        return $salary_currency;


    }

    public function get_contact_email(){

        $job_id = $this->job_id;

        $contact_email = get_post_meta($job_id, 'job_bm_contact_email', true);

        return $contact_email;


    }

    public function get_company_name(){

        $job_id = $this->job_id;

        $company_name = get_post_meta($job_id, 'job_bm_company_name', true);

        return $company_name;


    }



    public function get_location(){

        $job_id = $this->job_id;

        $location = get_post_meta($job_id, 'job_bm_location', true);

        return $location;


    }

    public function get_address(){

        $job_id = $this->job_id;

        $address = get_post_meta($job_id, 'job_bm_address', true);

        return $address;


    }

    public function get_company_website(){

        $job_id = $this->job_id;

        $company_website = get_post_meta($job_id, 'job_bm_company_website', true);

        return $company_website;


    }

    public function get_company_logo(){

        $job_id = $this->job_id;

        $company_logo = get_post_meta($job_id, 'job_bm_company_logo', true);

        return $company_logo;


    }



    public function is_featured(){

        $job_id = $this->job_id;

        $is_featured = get_post_meta($job_id, 'job_bm_featured', true);

        return $is_featured;


    }




    public function get_expire_date(){

        $job_id = $this->job_id;

        $expire_date = get_post_meta($job_id, 'job_bm_expire_date', true);

        return $expire_date;


    }


    public function get_tags($return = 'link', $separator = ','){

        $job_id = $this->job_id;

        $job_tags = get_the_terms($job_id, 'job_tag');

        if($return == 'link'){

            $total = count($job_tags);

            $html = '';
            $i =1;
            if(!empty($job_tags))
            foreach ($job_tags as $tag){

                $term_link = get_term_link($tag->term_id);
                $term_name = $tag->name;

                $html .= '<a class="job-tag" href="'.$term_link.'">'.$term_name.'</a>';

                if($i < $total)
                $html .= $separator;

                $i++;
            }

            return $html;

        }elseif ($return =='list'){

            $total = count($job_tags);

            $html = '';
            $html .= '<ul class="job-tags-wrap">';
            $i =1;
            if(!empty($job_tags))
                foreach ($job_tags as $tag){

                    $term_link = get_term_link($tag->term_id);
                    $term_name = $tag->name;

                    $html .= '<li><a class="job-tag" href="'.$term_link.'">'.$term_name.'</a></li>';

                    if($i < $total)
                        $html .= $separator;

                    $i++;
                }

            $html .= '</ul>';

            return $html;

        }elseif ($return =='object'){

            return $job_tags;

        }





    }



    public function get_categories($return = 'link', $separator = ','){

        $job_id = $this->job_id;

        $job_categories = get_the_terms($job_id, 'job_category');

        if($return == 'link'){

            $total = count($job_categories);

            $html = '';
            $i =1;
            if(!empty($job_categories))
                foreach ($job_categories as $category){

                    $term_link = get_term_link($category->term_id);
                    $term_name = $category->name;

                    $html .= '<a class="job-tag" href="'.$term_link.'">'.$term_name.'</a>';

                    if($i < $total)
                        $html .= $separator;

                    $i++;
                }

            return $html;

        }elseif ($return =='list'){

            $total = count($job_categories);

            $html = '';
            $html .= '<ul class="job-tags-wrap">';
            $i =1;
            if(!empty($job_categories))
                foreach ($job_categories as $category){

                    $term_link = get_term_link($category->term_id);
                    $term_name = $category->name;

                    $html .= '<li><a class="job-tag" href="'.$term_link.'">'.$term_name.'</a></li>';

                    if($i < $total)
                        $html .= $separator;

                    $i++;
                }

            $html .= '</ul>';

            return $html;

        }elseif ($return =='object'){

            return $job_categories;

        }





    }


}
