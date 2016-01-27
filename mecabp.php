<?php
class Mecabp {
  var $path = "/usr/local/bin/mecab";
  var $resultText;
  var $data;

  function MeCab($str = false) {
    if($str) $this->parse($str);
  }

  function parse($str) {
    $this->resultText = $this->execMeCab($str);
    $this->data = array();

    $lines = explode("\n", $this->resultText);
    foreach ($lines as $line) {
      $line = preg_replace("/,\*/", ",", $line);
      if(preg_match("/^([^\t]+)\t(.*)$/", $line, $match)) {
        $original = $match[1];
        $tmp = explode(",", $match[2]);

        list($conjKind, $conjCol) = explode("・", $tmp[4]);
        $this->data[] = array(
          "word" => $original,    // 元の単語
          "kind" => $tmp[0],      // 品詞
          "detail1" => $tmp[1],   // 品詞詳細１
          "detail2" => $tmp[2],   // 品詞詳細２
          "detail3" => $tmp[3],   // 品詞詳細３
          "conjKind" => $conjKind,// 活用形（サ変）
          "conjCol" => $conjCol,  // 活用段（ラ行）
          "conjForm" => $tmp[5],  // 活用型（連用形）
          "original" => $tmp[6],  // 原型
          "kana" => $tmp[7]       // 読み
        );
      }
    }
    return $this->data;
  }

  function execMeCab($str) {
    if (!function_exists('stream_get_contents')) {
      function stream_get_contents($handle) {
        $contents = '';
        while (!feof($handle)) {
          $contents .= fread($handle, 8192);
        }
        return $contents;
      }
    }
    $descriptorspec = array(
      0 => array("pipe", "r"), 1 => array("pipe", "w")
    );
    $result = "";
    $process = proc_open($this->path, $descriptorspec, $pipes);
    if (is_resource($process)) {
      fwrite($pipes[0], $str);
      fclose($pipes[0]);
      $result = stream_get_contents($pipes[1]);
      fclose($pipes[1]);
      proc_close($process);
    }
    return $result;
  }
}
?>
