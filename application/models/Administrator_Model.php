<?php
	class Administrator_Model extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
		}

		public function adminLogin($email, $encrypt_password){
			//Validate
			$this->db->where('email', $email);
			$this->db->where('password', $encrypt_password);

			$result = $this->db->get('users');

			if ($result->num_rows() == 1) {
				return $result->row(0);
			}else{
				return false;
			}
		}

		public function get_posts($slug = FALSE)
		{
			if($slug === FALSE){
				$query = $this->db->order_by('id', 'DESC');
				$query = $this->db->get('posts');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('posts', array('slug' => $slug));
			return $query->row_array();
		}

		public function create_post()
		{
			$slug = url_title($this->input->post('title'), "dash", TRUE);

			$data = array(
				'title' => $this->input->post('title'), 
			    'slug' => $slug,
			    'body' => $this->input->post('body'),
			    'category_id' => $this->input->post('category_id')
			    );
			return $this->db->insert('posts', $data);
		}

		public function delete($id,$table)
		{
			$this->db->where('id', $id);
			$this->db->delete($table);
			return true;
		}

		public function get_categories(){
			$this->db->order_by("id", "DESC");
			$query = $this->db->get('categories');
			return $query->result_array();
		}

		public function add_user($post_image,$encrypt_password)
		{
			$data = array('name' => $this->input->post('name'), 
							'email' => $this->input->post('email'),
							'password' => $encrypt_password,
							'username' => $this->input->post('username'),
							'zipcode' => $this->input->post('zipcode'),
							'contact' => $this->input->post('contact'),
							'address' => $this->input->post('address'),
							'gender' => $this->input->post('gender'),
							'role_id' => '2',
							'status' => $this->input->post('status'),
							'dob' => $this->input->post('dob'),
							'image' => $post_image,
							'password' => $encrypt_password,
							'register_date' => date("Y-m-d H:i:s")

						  );
			return $this->db->insert('users', $data);
		}

		public function get_users($username = FALSE, $limit = FALSE, $offset = FALSE)
		{
			if ($limit) {
				$this->db->limit($limit, $offset);
			}

			if($username === FALSE){
				$this->db->order_by('users.id', 'DESC');
				//$this->db->join('categories', 'categories.id = posts.category_id');
				$query = $this->db->get('users');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('users', array('username' => $username));
			return $query->row_array();
		}

		public function enable($id,$table){
			$data = array(
				'status' => 0
			    );
			$this->db->where('id', $id);
			return $this->db->update($table, $data);
		}
		public function desable($id,$table){
			$data = array(
				'status' => 1
			    );
			$this->db->where('id', $id);
			return $this->db->update($table, $data);
		}

		public function get_user($id = FALSE)
		{
			if($id === FALSE){
				$query = $this->db->get('users');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('users', array('id' => $id));
			return $query->row_array();
		}

		public function update_user_data($post_image)
		{ 
			$data = array('name' => $this->input->post('name'),
							'zipcode' => $this->input->post('zipcode'),
							'contact' => $this->input->post('contact'),
							'address' => $this->input->post('address'),
							'gender' => $this->input->post('gender'),
							'status' => $this->input->post('status'),
							'dob' => $this->input->post('dob'),
							'image' => $post_image,
							'register_date' => date("Y-m-d H:i:s")
						  );

			$this->db->where('id', $this->input->post('id'));
			$d = $this->db->update('users', $data);
		}

		

		

		

		 
		public function insertproductsmultipleImages($data = array()){
       	 $insert = $this->db->insert_batch('product_images',$data);
       	 return $insert?true:false;
    	}

		// Check Product SKU exists
		public function check_sku_exists($sku){
			$query = $this->db->get_where('products', array('sku' => $sku));

			if(empty($query->row_array())){
				return true;
			}else{
				return false;
			}
		}

		

		

		

		
		

		public function create_faq_category()
		{
			$data = array(
				'name' => $this->input->post('name'),
				'type' => 'faq',
				'status' => $this->input->post('status'),
				'user_id' => $this->session->userdata('user_id')
			    );
			return $this->db->insert('categories', $data);
		}

		public function faq_categories(){
			$this->db->order_by('id','desc');
			$this->db->where('type', 'faq');
			$query = $this->db->get('categories');
			return $query->result_array();
		}

		public function update_faq_category_data()
		{
			$data = array('name' => $this->input->post('name'),
							'status' => $this->input->post('status')
						  );

			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('categories', $data);
		}

		public function update_faq_category($id = FALSE)
		 {
		   	if($id === FALSE){
		    $query = $this->db->get('categories');
		    return $query->result_array(); 
		}
			$query = $this->db->get_where('categories', array('id' => $id));
			return $query->row_array();
		}


		//faq models functions start

		 public function create_faq()
		{
			$data = array('question' => $this->input->post('question'), 
							'answer' => $this->input->post('answer'),
							'faq_cat_id' => $this->input->post('faq_cat_id'),
							'status' => 1,
							'datetime' => date("Y-m-d H:i:s")
						);
			return $this->db->insert('faqs', $data);
		}


		public function get_faqs()
		{
			$this->db->select('categories.name catName, faqs.id as faqId,faqs.question,faqs.answer,faqs.datetime,faqs.status as faqStatus');
			$this->db->from('faqs');
			$this->db->join('categories', 'categories.id = faqs.faq_cat_id');
				
				$query=$this->db->get();
				return $data=$query->result_array();
		}

		public function update_faqs($id = FALSE)
		{
			if($id === FALSE){
				$query = $this->db->get('faqs');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('faqs', array('id' => $id));
			return $query->row_array();
		}

		public function update_faq_data()
		{
			$data = array('question' => $this->input->post('question'), 
							'answer' => $this->input->post('answer'),
							'faq_cat_id' => $this->input->post('faq_cat_id'),
							'status' => 1,
							'datetime' => date("Y-m-d H:i:s")
						);
			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('faqs', $data);
		}

		

		
		
		

		// blogs models functions starts
		public function create_blog($post_image)
		{
			$slug = url_title($this->input->post('title'), "dash", TRUE);

			$data = array(
				'title' => $this->input->post('title'), 
			    'slug' => $slug,
			    'body' => $this->input->post('body'),
			    'category_id' => $this->input->post('category_id'),
			    'post_image' => $post_image,
			    'user_id' => $this->session->userdata('user_id')
			    );
			return $this->db->insert('posts', $data);
		}

		public function listblogs($blogId = FALSE, $limit = FALSE, $offset = FALSE)
		{
			if ($limit) {
				$this->db->limit($limit, $offset);
			}

			if($blogId === FALSE){
				$this->db->order_by('posts.id', 'DESC');
				//$this->db->join('categories as cat', 'cat.id = posts.category_id');
				$query = $this->db->get('posts');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('posts', array('id' => $blogId));
			return $query->row_array();
		}

	
		public function update_blog_data($post_image){
			$slug = url_title($this->input->post('title'), "dash", TRUE);
			$data = array(
				'title' => $this->input->post('title'), 
			    'slug' => $slug,
			    'body' => $this->input->post('body'),
			    'category_id' => $this->input->post('category_id'),
			    'post_image' => $post_image
			    );
			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('posts', $data);
		}

		

		



		

		

		public function get_galleries_images(){
			$this->db->order_by('id','desc');
			$query = $this->db->get('galleries');
			return $query->result_array();
		}

		

		public function create_testimonial($uploaded_image)
		{

			$data = array(
				'name' => $this->input->post('name'), 
			    'domain' => $this->input->post('domain'),
			    'description' => $this->input->post('description'),
			    'image' => $uploaded_image,
			    'status' => $this->input->post('status')
			    );
			return $this->db->insert('testimonials', $data);
		}

		public function listtestimonial($id = FALSE, $limit = FALSE, $offset = FALSE)
		{
			if ($limit) {
				$this->db->limit($limit, $offset);
			}

			if($id === FALSE){
				$this->db->order_by('testimonials.id', 'DESC');
				//$this->db->join('categories as cat', 'cat.id = posts.category_id'); 
				$query = $this->db->get('testimonials');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('testimonials', array('id' => $id));
			return $query->row_array();
		}

		public function update_testimonial_data($uploaded_image){
			//$slug = url_title($this->input->post('title'), "dash", TRUE);
			$data = array(
				'name' => $this->input->post('name'), 
			    'domain' => $this->input->post('domain'),
			    'description' => $this->input->post('description'),
			    'image' => $uploaded_image,
			    'status' => $this->input->post('status')
			    );
			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('testimonials', $data);
		}

		public function get_admin_data()
		{
			$id = $this->session -> userdata('user_id');
			if($id === FALSE){
				$query = $this->db->get('users');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('users', array('id' => $id));
			return $query->row_array();
		}

		public function change_password($new_password){

			$data = array(
				'password' => md5($new_password)
			    );
			$this->db->where('id', $this->session->userdata('user_id'));
			return $this->db->update('users', $data);
		}

		public function match_old_password($password)
		{
			$id = $this->session -> userdata('user_id');
			if($id === FALSE){
				$query = $this->db->get('users');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('users', array('password' => $password));
			return $query->row_array();

		}

		// function start fron forget password

		public function email_exists(){
    $email = $this->input->post('email');
    $query = $this->db->query("SELECT email, password FROM users WHERE email='$email'");    
    if($row = $query->row()){
        return TRUE;
    }else{
        return FALSE;
    }
}
public function temp_reset_password($temp_pass){
    $data =array(
                'email' =>$this->input->post('email'),
                'reset_pass'=>$temp_pass);
                $email = $data['email'];

    if($data){
        $this->db->where('email', $email);
        $this->db->update('users', $data);  
        return TRUE;
    }else{
        return FALSE;
    }

}
public function is_temp_pass_valid($temp_pass){
    $this->db->where('reset_pass', $temp_pass);
    $query = $this->db->get('users');
    if($query->num_rows() == 1){
        return TRUE;
    }
    else return FALSE;
}

	}