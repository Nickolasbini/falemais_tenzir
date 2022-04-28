<?php

namespace App\Helpers;

class TableGenerator
{
    private $dataArray;
    private $headers;
    private $columns;
    private $hidden;
    private $html;
    private $headerTranslation = [];

    /**
     * Constructor method
     *
     * @param  \Illuminate\Database\Eloquent\Collection
     * @return nill
     */
    public function __construct($eloquentCollectionObj)
    {
        $this->setDataArray($eloquentCollectionObj);
        $this->extractHeaders();
    }

    /**
     * Sets a value to private dataArray variable
     *
     * @param  int
     * @return nill
     */
    public function setDataArray($dataArray)
    {
        $this->dataArray = $dataArray;
    }

    /**
     * Gets the value of private dataArray variable
     *
     * @return array
     */
    public function getDataArray()
    {
        return $this->dataArray;
    }

    /**
     * Sets a value to private headers variable
     *
     * @param  int
     * @return nill
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    /**
     * Gets the value of private headers variable
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Sets a value to private columns variable
     *
     * @param  int
     * @return nill
     */
    public function setColumns($columns)
    {
        $this->columns = $columns;
    }

    /**
     * Gets the value of private columns variable
     *
     * @return array
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Sets a value to private hidden variable
     *
     * @param  int
     * @return nill
     */
    public function setHidden($hidden)
    {
        $this->hidden = $hidden;
    }

    /**
     * Gets the value of private hidden variable
     *
     * @return array
     */
    public function getHidden()
    {
        return $this->hidden;
    }

    /**
     * Sets a value to private html variable
     *
     * @param  int
     * @return nill
     */
    public function setHtml($html)
    {
        $this->html = $html;
    }

    /**
     * Gets the value of private html variable
     *
     * @return array
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * Sets a value to private headerTranslation variable
     *
     * @param  int
     * @return nill
     */
    public function setHeaderTranslation($headerTranslation)
    {
        $this->headerTranslation = $headerTranslation;
    }

    /**
     * Gets the value of private headerTranslation variable
     *
     * @return array
     */
    public function getHeaderTranslation()
    {
        return $this->headerTranslation;
    }

    /**
     * Extracts the headers
     *
     * @return nill
     */
    public function extractHeaders()
    {
        $objectsArray  = $this->getDataArray();
        $attributes = $objectsArray[0]->getAttributes();
        $attributesNames = array_keys($attributes);
        $this->setHeaders($attributesNames);
    }

    /**
     * Generate the table html
     *
     * @param  \Illuminate\Database\Eloquent\Collection
     * @return nill
     */
    public function getTableHtml()
    {
        $objectsArray      = $this->getDataArray();
        $columnsToHide     = $this->getHidden();
        $headerTranslation = $this->getHeaderTranslation();
        $html  = '<table class="table table-sm">';
        $html .= '<thead>';
        $html .= '<tr>';
        $headers = $this->getHeaders();
        foreach($headers as $header){
            if(in_array($header, $columnsToHide))
                continue;
            if(array_key_exists($header, $headerTranslation))
                $header = $headerTranslation[$header];
            $html .= '<th scope="col">'.$header.'</th>';
        }
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        foreach($objectsArray->toArray() as $attributesArray){
            foreach($columnsToHide as $columnName){
                if(array_key_exists($columnName, $attributesArray))
                    unset($attributesArray[$columnName]);
            }
            $html .= '<tr>';
            foreach($attributesArray as $attribute){
                $html .= '<td>'.$attribute.'</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';
        return $html;
    }
}