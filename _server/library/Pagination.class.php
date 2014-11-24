<?php
/**
 * @author           Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright        (c) 2012-2014, Pierre-Henry Soria. All Rights Reserved.
 * @license          GNU General Public License
 * @version          1.0
 * @link             <http://software.hizup.com>
 */

namespace H2O;
defined('H2O') or exit('Access denied');

class Pagination
{

    private $_sPageName, $_iTotalPages, $_iCurrentPage, $_iShowItems, $_sHtmlOutput;

    private $_aOptions = [
        'range'               => 3, // Number of items to display on each side of the current page
        'text_first_page'     => '&laquo;', // Button text "First Page"
        'text_last_page'      => '&raquo;', // Button text "Last Page"
        'text_next_page'      => '&rsaquo;', //  Button text "Next"
        'text_previous_page'  => '&lsaquo;' // Button text "Previous"
    ];

    /**
     * Constructor
     *
     * @param integer $iTotalPages
     * @param integer $iCurrentPage
     * @param string $sPageName Default 'p'
     * @param array $aOptions Optional options.
     */
    public function __construct($iTotalPages, $iCurrentPage, $sPageName = 'p', array $aOptions = array())
    {
        // Set the total number of page
        $this->_iTotalPages = $iTotalPages;

        // Retrieve the number of the current page
        $this->_iCurrentPage = $iCurrentPage;

        // Put options update
        $this->_aOptions += $aOptions;

        // It retrieves the address of the page
        $this->_sPageName = Page::cleanDynamicUrl($sPageName);


        // Management pages to see
        $this->_iShowItems = ($this->_aOptions['range'] * 2) + 1;

        // It generates the paging
        $this->_generate();
    }

    /**
     * Display the pagination if there is more than one page
     *
     * @return string Html code.
     */
    public function getHtmlCode()
    {
        return $this->_sHtmlOutput;
    }

    /**
     * Generate the HTML pagination code.
     *
     * @return void
     */
    private function _generate()
    {
        // If you have more than one page, it displays the navigation
        if ($this->_iTotalPages > 1)
        {
            $this->_sHtmlOutput = '<div class="clear"></div><div class="pagination">';

            // Management link to go to the first page
            if ($this->_aOptions['text_first_page'])
            {
                if ($this->_iCurrentPage > 2 && $this->_iCurrentPage > $this->_aOptions['range']+1 && $this->_iShowItems < $this->_iTotalPages)
                    $this->_sHtmlOutput .= '<a href="' . $this->_sPageName . '1">' . $this->_aOptions['text_first_page'] . '</a>';
            }

            // Management the Previous link
            if ($this->_aOptions['text_previous_page'])
            {
                if ($this->_iCurrentPage > 2 && $this->_iShowItems < $this->_iTotalPages)
                    $this->_sHtmlOutput .= '<a href="' . $this->_sPageName . ($this->_iCurrentPage-1) . '">' . $this->_aOptions['text_previous_page'] . '</a>';
            }
            // Management of other paging buttons...
            for ($i=1; $i <= $this->_iTotalPages; $i++)
            {
                if (($i >= $this->_iCurrentPage - $this->_aOptions['range'] && $i <= $this->_iCurrentPage + $this->_aOptions['range']) || $this->_iTotalPages <= $this->_iShowItems)
                    $this->_sHtmlOutput .= ($this->_iCurrentPage == $i) ? '<span class="current">' . $i . '</span>' : '<a href="' . $this->_sPageName . $i . '" class="inactive">' . $i . '</a>';
            }

            //  Management the "Next" link
            if ($this->_aOptions['text_next_page'])
            {
                if ($this->_iCurrentPage < $this->_iTotalPages - 1 && $this->_iShowItems < $this->_iTotalPages)
                    $this->_sHtmlOutput .= '<a href="' . $this->_sPageName . ($this->_iCurrentPage+1) . '">' . $this->_aOptions['text_next_page'] . '</a>';
            }

            // Management link to go to the last page
            if ($this->_aOptions['text_last_page'])
            {
                if ($this->_iCurrentPage < $this->_iTotalPages-1 && $this->_iCurrentPage + $this->_aOptions['range'] < $this->_iTotalPages && $this->_iShowItems < $this->_iTotalPages)
                    $this->_sHtmlOutput .= '<a href="' . $this->_sPageName . $this->_iTotalPages . '">' . $this->_aOptions['text_last_page'] . '</a>';
            }

            $this->_sHtmlOutput .= '</div>';
        }
    }

    public function __destruct()
    {
        unset(
            $this->_sPageName,
            $this->_iTotalPages,
            $this->_iCurrentPage,
            $this->_iShowItems,
            $this->_sHtmlOutput
        );
    }

}