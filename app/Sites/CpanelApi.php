<?php 

namespace claymalven\Sites;

use Illuminate\Support\Facades\App;
use xmlapi;

/**
 *
 */
class CpanelApi extends xmlapi{

    private $user;
    private $host;
    private $password;
    private $publicDirectory;

    function __construct($host,$user,$password)
    {
        parent::__construct($host,$user,$password);
        $this->set_port(2083);
        $this->set_output('array');
        $this->set_debug(1);
        $this->password_auth($user,$password);
        $this->user = $user;
        $this->host = $host;
        $this->password = $password;
    }

    private function set_public_directory($directory)
    {
      $this->publicDirectory = $directory;
    }

    private function retrievePublicDirectory()
    {
        $query = $this->api2_query($this->user,"Fileman","getdir",['dir' => 'public_html']);
        $this->set_public_directory(urldecode($query['data']['dir']));
    }

    public function getPublicDirectory()
    {
      return $this->publicDirectory;
    }

    private function file_upload_curl_query($payload)
    {
      $ch = curl_init( parent::get_protocol() . '://' . $this->host . ':' . parent::get_port() .'/execute/Fileman/upload_files' );
      curl_setopt( $ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC );
      curl_setopt( $ch, CURLOPT_USERPWD, $this->user . ':' . $this->password );
      curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
      curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
      curl_setopt( $ch, CURLOPT_POST, true );
      curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

      $curl_response = curl_exec( $ch );
      curl_close( $ch );

      $response = json_decode( $curl_response );

      if( empty( $response ) ) {
          echo "The cURL call did not return valid JSON:\n";
          die( $response );
      } elseif ( !$response->status ) {
          echo "The cURL call returned valid JSON, but reported errors:\n";
          die( $response->errors[0] . "\n" );
      }

      return $response;
    }

    public function uploadFile($file_location)
    {
      function_exists( 'curl_file_create' )  ? $cf = curl_file_create( realpath($file_location) ) : $cf = "@/".realpath($file_location);

      $payload = array(
          'dir'    => urlencode( $directory ),
          'file-1' => $cf
      );

      return $this->file_upload_curl_query($payload);
    }

    public function uploadMultipleFiles($directory,$files)
    {
      $payload = array(
          'dir'    => urlencode( $directory )
      );

      foreach ($files as $key => $value) {
        $fileNumber = $key + 1;
        function_exists( 'curl_file_create' ) ) ? $payload['file-'.$fileNumber] = curl_file_create( realpath($value) ) : $payload['file-'.$fileNumber] = "@/".realpath($value);
      }

      return $this->file_upload_curl_query($payload);
    }
}

 ?>
