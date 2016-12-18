<?php

class Pagination
{
    public $currentPage;
    public $countPages;
    public $vars;

    public function __construct($currentPage,$countPages,$vars){
        $this->countPages = $countPages;
        $this->currentPage = $currentPage;
        $this->vars = $vars;
    }
    //вернуть блоки страниц пагинации
    /**
     * @param $source
     * @return array
     */
    public function getLinks($source){
        $res = array();
        //если 1 страница - не отрисовываем пагинацию
        if($this->countPages<2)return array();
            //для пагинации, которая поместится на экране
        elseif ($this->countPages<=9){
            for($i=1;$i<=$this->countPages;$i++){
                if($i==$this->currentPage) $active = 'active';
                else $active = '';
                array_push($res,'<div class="pageButton '.$active.'"><a href="'.HTTP_SERVER.'/count-'.$this->vars['countItems'].'/page-'.$i.'/source-'.$source.'/sort-'.$this->vars['sort'].'">'.$i.'</a></div>');
            }
            return $res;
        }
        //если не поместится - определяем смещение страниц
        else{
            if($this->currentPage<=5){
                for($i=1;$i<=9;$i++){
                    if($i==$this->currentPage) $active = 'active';
                    else $active = '';
                    array_push($res,'<div class="pageButton '.$active.'"><a href="'.HTTP_SERVER.'/count-'.$this->vars['countItems'].'/page-'.$i.'/source-'.$source.'/sort-'.$this->vars['sort'].'">'.$i.'</a></div>');
                }
                return $res;

            }
            else{
                if($this->countPages<=$this->currentPage+4){
                    for($i=$this->currentPage-(8-$this->countPages+$this->currentPage);$i<=$this->countPages;$i++){
                        if($i==$this->currentPage) $active = 'active';
                        else $active = '';
                        array_push($res,'<div class="pageButton '.$active.'"><a href="'.HTTP_SERVER.'/count-'.$this->vars['countItems'].'/page-'.$i.'/source-'.$source.'/sort-'.$this->vars['sort'].'">'.$i.'</a></div>');
                    }
                    return $res;
                }
                else{
                    for($i=$this->currentPage-4;$i<=$this->currentPage+4;$i++){
                        if($i==$this->currentPage) $active = 'active';
                        else $active = '';
                        array_push($res,'<div class="pageButton '.$active.'"><a href="'.HTTP_SERVER.'/count-'.$this->vars['countItems'].'/page-'.$i.'/source-'.$source.'/sort-'.$this->vars['sort'].'">'.$i.'</a></div>');
                    }
                    return $res;
                }
            }
        }
    }
}