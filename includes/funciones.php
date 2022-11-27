<?php  
    function debuguear($variable) : string {
        echo "<pre>";
        var_dump($variable);
        echo "</pre>";
        exit;
    }
    
    // Escapa / Sanitizar el HTML
    function s($html) : string {
        $s = htmlspecialchars($html);
        return $s;
    }

    //funcion que revisa que el usuario este autenticado
    function isAuth() : void{
        if(isset($_SESSION['login'])){
            if($_SESSION['login'] !== true){
                header('Location: /');
            }
        }else{
            header('Location: /');
        }
    }

    function isAdmin(): void{
        if(isset($_SESSION['admin'])){
            if($_SESSION['admin'] !== '1'){
                header('Location: /');
            }
        }else{
            header('Location: /');
        }
    }

    function last(string $current, string $next): bool{
        if($current !== $next){
            return true;
        }
        
        return false;
    }
?>