<?
/**
 * Classe de Envio de arquivo Via FTP
 * 
 * @author Laércio R. Crestani
 * @license Restrita ao uso comercial á Empresa Ween Web Solutions
 * 
 * @category PHP CLASS
 * @package FILE UPLOAD COM FTP E RESISE DE IMG
 */
class upload {
	public $ftp_host;
	public $ftp_user;
	public $ftp_pass;
	
	public $img_width = 300;
	public $img_height = 300;
	
    public $tmb_width = 90;
    public $tmb_height = 90;
	
	public $ftp_id;
	
	public $file_tmp_dir	= '../tmp_up/'; 
	
	public $cli_img_dir		= '_img/';
	public $cli_tmb_dir		= 'thumb/';
	
	public $img_db_name;
	
	private $file_full_path;
	
	private $img_org;
	
	public $mode 			= FTP_ASCII;
	
	private $file_name, $file_tmp_name, $file_size, $file_type;
	
	private $stats_move_file = false;
	
	private $img_status = false;
	
	private $tmb_status = false;
	
	public $form_file_type = false;
	
	public function __construct($files, $form_file_type = '') {	
	
		$this->form_file_type = $form_file_type;
	
		$this->ftp_host = decripfy($_SESSION['ftp_host'],'h0s7');
		$this->ftp_user = decripfy($_SESSION['ftp_user'],'h0s7');
		$this->ftp_pass = decripfy($_SESSION['ftp_pass'],'h0s7');
		$this->ftp_id 	= $_SESSION['id_tg_usuario'];
		
		if($files['error'] !== 0){ # se houver erros de envio
			$this->error('Houve um Erro ao Uplodear a imagem.');
		}else{ # se não houver erros de envio
			
			$this->file_name 		= $files['name'];
			$this->file_tmp_name 	= $files['tmp_name'];
			$this->file_size 		= $files['size'];
			$this->file_type 		= $files['type'];
			
			if(!$this->form_file_type){
				if(!$this->file_get_type()){
					$this->error('O arquivo Upado n&atilde;o é uma imagem.');	
				}
			}
		}
	}	
	/**
	 * Verifica se é uma imagem válida!
	 */
	private	function file_get_type(){
		switch($this->file_type){
			case 'image/pjpeg'	: return true;
			break;
			case 'image/jpeg' 	: return true;
			break;
			case 'image/jpg' 	: return true;
			break;
			case 'image/gif' 	: return true;	
			break;
			case 'application/pdf' 	: return true;	
			break;
			default				: return false;
		}
	}
	/**
	 * Cria diretório
	 */
	private function mk_dir(){
		#echo realpath('/tmp_up/');
		if($this->img_status === true){
			if(!is_dir($this->file_tmp_dir.$this->ftp_id)){ # Se o diretorio não existir, então
				if(!mkdir($this->file_tmp_dir.$this->ftp_id, 0777)){ # cria o diretório
					return false;
				}
			}
		}
		if($this->tmb_status === true){
			if(!is_dir($this->file_tmp_dir.$this->ftp_id.'/tmb')){ # Se o diretorio não existir, então
				if(!mkdir($this->file_tmp_dir.$this->ftp_id.'/tmb', 0777)){ # cria o diretório
					return false;
				}
			}
		}
		if($this->form_file_type === 'audio' || $this->form_file_type === 'all'){
			if(!is_dir($this->file_tmp_dir.$this->ftp_id)){ # Se o diretorio não existir, então
				if(!mkdir($this->file_tmp_dir.$this->ftp_id, 0777)){ # cria o diretório
					return false;
				}
			}
		}
		
		return true;
	} 
	/**
	 * Move o arquivo temporário para a pasta temporária
	 */
	private function move_file(){
		if (!move_uploaded_file ($this->file_tmp_name, $this->file_tmp_dir.$this->ftp_id.'/'.$this->file_name)){
			return false;	
		}
		# escreve na variável o caminho total para acessar o arquivo upado.
		$this->file_full_path = $this->file_tmp_dir.$this->ftp_id.'/'.$this->file_name;
		$this->stats_move_file = true;
		return $this;
	}
	/**
	 * Envia Arquivo
	 */
	 public function send_file(){
		if(!$this->mk_dir()){
			$this->error('Houve um Erro ao Criar o diretório: '.$this->file_tmp_dir.$this->ftp_id);
		}
		if(!$this->move_file()){
			$this->error('Houve um Erro ao Mover a imagem.');	
		}
		
		$ext = substr($this->file_name, -4);
				
		$new_name = date("U");
				
		$this->img_db_name = strtolower($new_name.$ext);
		
		if($this->stats_move_file){
			$this->start_ftp_connection();
		}
	}
	/**
	 * Redimensiona a imagem
	 */
	public function img_resize($img_status = false, $tmb_status = false){
		if($img_status){
			$this->img_status = true;
		}
		if($tmb_status){
			$this->tmb_status = true;
		}
		
		if(!$this->mk_dir()){
			$this->error('Houve um Erro ao Criar o diretório: '.$this->file_tmp_dir.$this->ftp_id);
		}
		if(!$this->move_file()){
			$this->error('Houve um Erro ao Mover a imagem.');	
		}
		

		if($this->stats_move_file){ #verifica se o arquivo foi movido com sucesso
			switch($this->file_type){
			case 'image/pjpeg'	: $this->img_org = imagecreatefromjpeg($this->file_full_path);
			break;
			case 'image/jpeg' 	: $this->img_org = imagecreatefromjpeg($this->file_full_path);
			break;
			case 'image/jpg' 	: $this->img_org = imagecreatefromjpeg($this->file_full_path);
			break;
			case 'image/gif' 	: $this->img_org = imagecreatefromgif($this->file_full_path);
			break;
			default				: return 'Imagem inválida -> '.$this->file_name;
			}
		}
		if($this->img_status){
			/**
	 		* Redimensiona a IMAGEM
	 		*/
			$img_tmb_get_size = $this->img_tmb_get_size();
			if($img_tmb_get_size){
				$img_cus = imagecreatetruecolor($img_tmb_get_size[2], $img_tmb_get_size[3]);
				imagecopyresampled(
					$img_cus,
					$this->img_org, 0, 0, 0, 0,
					$img_tmb_get_size[2],
					$img_tmb_get_size[3],
					$img_tmb_get_size[0],
					$img_tmb_get_size[1]
				);
				
				$ext = substr($this->file_name, -4);
				
				$new_name = date("U");
				
				$this->img_db_name = strtolower($new_name.$ext);
				
				imagejpeg($img_cus, $this->file_tmp_dir.$this->ftp_id.'/'.$this->img_db_name, 85);
				
				# Redimensionar Thumb
				if($this->tmb_status){
					$this->tmb_resize(); #Redimensiona o Thumb
				}else{
					$this->start_ftp_connection();
				}		
			}else{
				$this->error("Houve um erro ao redimensionar Imagem.");
			}
		}
	}
	/**
 	* Redimensiona o THUMB
	*/
	public function tmb_resize(){
		$img_tmb_get_size = $this->img_tmb_get_size();
		if($img_tmb_get_size){
			
			$new_w = (($img_tmb_get_size[4] / 2) - ($this->tmb_width / 2));
			$new_h = (($img_tmb_get_size[5] / 2) - ($this->tmb_heigth / 2));
				
			$tmb_cus = imagecreatetruecolor($img_tmb_get_size[4], $img_tmb_get_size[5]);					
			imagecopyresampled(
				$tmb_cus,
				$this->img_org, 0, 0, new_w, new_h,
				$img_tmb_get_size[4],
				$img_tmb_get_size[5],
				$img_tmb_get_size[0],
				$img_tmb_get_size[1]
			);
			imagejpeg($tmb_cus, $this->file_tmp_dir.$this->ftp_id.'/tmb/'.$this->img_db_name, 85);
			
			$this->start_ftp_connection();
		
		}else{
			$this->error("Houve um erro ao redimensionar o Thumb.");
		}
	}	
	/**
	 * Lista as dimensões da imagen redimensionada e thumb
	 */
	public function img_tmb_get_size(){
		list($org_width, $org_height) = getimagesize($this->file_full_path);
		$radio = ($org_height / $org_width);
		
		// Se a imagem upada for maior que o tamanho da imagem redimensionada 
		//if ($org_width >= $this->img_width || $org_height >= $this->img_height){
			// largura MAIOR que altura
			if ($org_height < $org_width){
				$img_height_cus = $this->img_width * $radio;
				$img_width_cus 	= $this->img_width;
				
				$tmb_height_cus = $this->tmb_width * $radio;	 
				$tmb_width_cus	= $this->tmb_width;
			// altura MAIOR que largura	
			}else if($org_width > $org_width){						
				$img_height_cus	= $this->img_height;
				$img_width_cus 	= $this->img_height / $radio;
				
				$tmb_height_cus = $this->tmb_height;	 
				$tmb_width_cus	= $this->tmb_height / $radio;				
			}else{													
				// largura IGUAL à altura
				$img_height_cus	= $this->img_height;
				$img_width_cus 	= $this->img_height / $radio;
				//
				$tmb_height_cus = $this->tmb_width * $radio;	 
				$tmb_width_cus	= $this->tmb_width;
			}
			# retorna array com a largura e altura da imagem e do thumb.
			return array($org_width, $org_height, $img_width_cus, $img_height_cus, $tmb_width_cus, $tmb_height_cus);
		//}else{
			//return array($org_width, $org_height, $this->img_width, $this->img_height, $this->tmb_width, $this->tmb_height);	
		//}
	}
	/**
	 * @return boolean
	 */
	protected function start_ftp_connection(){
		if(@!$this->conn = ftp_connect($this->ftp_host)){
			$this->error('Erro ao localizar o HOST -> '.$this->ftp_host);
		}
		if(@ftp_login($this->conn, $this->ftp_user, $this->ftp_pass)){
			if($this->img_status === true){
				if(!$this->select_dir($this->cli_img_dir)){
					$this->error('Erro ao localizar ou mudar permiss&atilde;o na pasta Imagem do cliente, 204');	
				}
				if(!$this->upload_file('img')){
					$this->error('Erro ao Uploadear Imagem.');		
				}	
			}
			if($this->tmb_status === true){
				if(!$this->select_dir($this->cli_tmb_dir)){
					$this->error('Erro ao localizar ou mudar permiss&atilde;o na pasta Thumb do cliente, 205');
				}
				if(!$this->upload_file('thumb')){
					$this->error('Erro ao Uploadear Imagem.');		
				}
			}
			########################
			
			if($this->form_file_type){
				if(!$this->select_dir($this->cli_img_dir)){
					$this->error('Erro ao localizar ou mudar permiss&atilde;o na pasta do cliente, 206');
				}
				if(!$this->upload_file('all')){
					$this->error('Erro ao Uploadear O Arquivo.');		
				}	
			}
			
			########################
			if(!$this->remove_files_on_server()){
				$this->error('Erro ao Deletar arquivos do servidor.');							  
			}
			return true;
		}else{
			$this->error('Erro ao logar, Usuário ou senha incorretos.');
			return false;
		}
	}	
	/**
	 * Change dir in server to target
	 */
	protected function select_dir($dir) {
		#ftp_pwd($this->conn);	 
		ftp_pasv($this->conn, true);
		// change dir in server to target
		if(ftp_chdir($this->conn, $dir)){
			return true;	
		}
		#ftp_pwd($this->conn);
		return false;
	}
	/**
	 * This function will move your file to ftp server
	 *
	 * @param your_filename_ $upload_file
	 * @param your_old_file $newfilename (not need)
	 * @return boolean
	 */
	protected function upload_file($a) {
		if($a === 'img'){
			if(!ftp_put($this->conn, $this->img_db_name, $this->file_tmp_dir.$this->ftp_id.'/'.$this->img_db_name, $this->mode)){
				$this->error('Erro ao gravar a imagem na pasta ('.$this->cli_img_dir.') do cliente.');
			};
		}else if($a === 'thumb'){
			if(!ftp_put($this->conn, $this->img_db_name, $this->file_tmp_dir.$this->ftp_id.'/tmb/'.$this->img_db_name, $this->mode)){
				$this->error('Erro ao gravar a imagem na pasta ('.$this->cli_img_dir.') do cliente.');
			};
		}else if($a === 'all'){
			if(!ftp_put($this->conn, $this->img_db_name, $this->file_tmp_dir.$this->ftp_id.'/'.$this->file_name, $this->mode)){
				$this->error('Erro ao gravar o arquivo na pasta ('.$this->cli_img_dir.') do cliente.');
			};
		}else{
			$this->error('ERROR.');
		}
		return true;
	}
	private static function error($msg){
		exit($msg);
	}
	/**
	 * REMOVE OS ARQUIVOS E AS PASTAS DO SERVIDOR "WEEN"
	 */
	private function remove_files_on_server(){
		if($this->img_status === true){
			if(!unlink($this->file_tmp_dir.$this->ftp_id.'/'.$this->img_db_name)){
				$this->error('Erro ao deletar IMAGEM -> ('.$this->img_db_name.') do servidor WEEN');
			}
			if(!unlink($this->file_tmp_dir.$this->ftp_id.'/'.$this->file_name)){
				$this->error('Erro ao deletar IMAGEM -> ('.$this->file_name.') do servidor WEEN');
			}	
		}
		if($this->tmb_status === true){
			if(!unlink($this->file_tmp_dir.$this->ftp_id.'/tmb/'.$this->img_db_name)){
				$this->error('Erro ao deletar THUMB -> ('.$this->img_db_name.') do servidor WEEN');
			}
		
			if(!rmdir($this->file_tmp_dir.$this->ftp_id.'/tmb/')){
				$this->error('Erro ao deletar DIRET&Oacute;RIO -> ('.$this->file_tmp_dir.$this->ftp_id.'/tmb/) do servidor WEEN');
			}
		}
		if($this->form_file_type === 'all' || $this->form_file_type === 'img'){
			if(!unlink($this->file_tmp_dir.$this->ftp_id.'/'.$this->file_name)){
				$this->error('Erro ao deletar IMAGEM -> ('.$this->img_db_name.') do servidor WEEN');
			}	
		}
		if(!rmdir($this->file_tmp_dir.$this->ftp_id)){
			$this->error('Erro ao deletar DIRET&Oacute;RIO -> ('.$this->file_tmp_dir.$this->ftp_id.'/) do servidor WEEN');
		}
		return true;
	}
	/**
	 * This function logout from server and close the ftp connection.
	 */
	public function close_connection() {
		$this->connection = false;
		@ftp_quit($this->conn);
	}

    




	/**
	 * Close the connection at end of class so not need to close manually
	 */
	public function __destruct() {
		$this->close_connection();
	}
}

?>