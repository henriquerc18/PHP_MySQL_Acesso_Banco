<?php
	namespace controle{
		include 'processaAcesso.php';
		
		$controle = new \processaAcesso\ProcessaAcesso;
		if(@$_POST['enviar']){
			$login = $_POST['login'];
			$senha = md5 ($_POST['senha']);
			$usuario = $controle->verificaAcesso($login, $senha);
			echo $login;
			echo $senha;
			if($usuario[0]['acesso_idAcesso'] == 1){
				header("Location: pagina1.html");
			}/*else if($usuario[0]['acesso_idAcesso'] == 2){
				header("Location: pagina2.html");
			}else{
				header("Location: pagina3.html");
			}*/
		}else if($_POST['cadastrar']){
			$login = $_POST['login'];
			$senha = md5($_POST['senha']);
			$acesso_idAcesso = $_POST['tipo_usuario'];
			$grupo=$_POST['grupo'];
			$arr = array('usuario' => $login, 'senha' => $senha, 'acesso_idAcesso' => $acesso_idAcesso, 'tb_grupo_idGrupo'=>$grupo);
			if(!$controle->cadastraUsuario($arr)){
				echo 'Aconteceu algum erro';
			}else{
				$acesso_idAcesso = $controle->verificaAcesso($login, $senha);
				if($acesso_idAcesso[0]['acesso_idAcesso'] == 1){
					header("Location: pagina1.html");
				}else if($acesso_idAcesso[0]['acesso_idAcesso'] == 2){
					header("Location: pagina2.html");
				}
			}
		}
	}
?>
