<?php

namespace  Framework\View;

/**
 *  * La raison de cette class c'est une contrat pour que la class View implement obligatoirement ces method
 * Interface ViewInterface
 */
interface ViewInterface
{
    /*** @return mixed */
    public function getFileName();

    /**
     * @param $data
     * @return mixed
     */
    public function generatePageContent($data);

    /**
     * @param $fileName
     * @param $data
     * @return mixed
     */
    public function generateViewContent($fileName, $data);

}