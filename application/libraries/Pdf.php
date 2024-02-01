<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;

class Pdf extends Dompdf {
    /**
     * PDF filename
     * @var string
     */
    public $filename;

    public function __construct(){
        parent::__construct();
        $this->filename = "Laporan.pdf";
    }

    /**
     * Get an instance of CodeIgniter
     *
     * @access    protected
     * @return    void
     */
    protected function ci()
    {
        return get_instance();
    }

    /**
     * Load a CodeIgniter view into domPDF
     *
     * @access    public
     * @param    string    $view The view to load
     * @param    array    $data The view data
     * @return    void
     */
    public function load_view($detailpenjualan, $data = array()){
        // Memuat HTML dari view CodeIgniter
        $html = $this->ci()->load->view($detailpenjualan, $data, TRUE);
    
        // Memuat HTML ke objek Dompdf
        $this->load_html($html);
    
        // Merender PDF
        $this->render();
    
        // Menampilkan PDF yang dihasilkan ke Browser
        $this->stream($this->filename, array("Attachment" => false));
    }
    
}