<?php
class Markov {

  function summarize($text, $gram = 3) {

    if (is_array($text)) $words = $text;
    elseif (is_string($text)) $words = $this->sloppy_analysis($text);
    else return false;
    $table = array();

    for ( $i = 0; $i < count($words) - ($gram - 1); $i++ ) {
      $g = array();
      //n-gram分回す
      for ($j = 0; $j < $gram; $j++) {
        $g[$j] = $words[$i + $j];
      }
      $table[] = $g;
    }

    $t = array();
    $summary = "";
    for ($i = 0; $i < $gram - 1; $i++) {
      $t[$i] = $table[0][$i];
      $summary .= $table[0][$i];
    }


    while (true) {
      $a = array();
      foreach ($table as $h) {
        $flg = 0;
        for ($i = 0; $i < $gram - 1; $i++) {
          if ($h[$i] == $t[$i]) $flg++;
        }
        if ($flg == $gram - 1) $a[] = $h;
      }

      if (count($a) == 0) break;
      $num = array_rand($a);
      $summary .= $a[$num][$gram - 1];

      //200文字
      if (mb_strlen($summary) >= 200 && $a[$num][$gram - 1] == "。") {
        break;
      }

      if ($a[$num][$gram - 1] == "EOS") break ;

      for ($i = 0; $i < $gram - 1; $i++) {
        $t[$i] = $a[$num][$i + 1];
      }
    }
    return preg_replace('/EOS$/', '', $summary);

  }

  function sloppy_analysis($text) {
    $re = '/[一-龠]+|[ぁ-ん]+|[ァ-ヴー]+|[a-zA-Z0-9]+|[ａ-ｚＡ-Ｚ０-９]+|[、。！!？?]+/u';
    preg_match_all($re, $text, $m);
    return $m[0];
  }
}
