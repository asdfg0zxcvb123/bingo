<?php

  // マス目のサイズ
  $S = (int)fgets(STDIN);

  // ビンゴカードに入力されている文字数
  $cardWords = [];
  for($i = 0; $i < $S; $i++) {
    $cardWords[$i] = explode(" ", trim(fgets(STDIN)));
  }

  // 単語の個数
  $N = (int)fgets(STDIN);

  // 単語の取得
  $inputWords = [];
  for($i = 0; $i < $S; $i++) {
    $inputWords[] = explode(" ", trim(fgets(STDIN)));
  }

  // 入力された単語がカードにあるか判定
  foreach($inputWords as $word) {
    for($i = 0; $i < $S; $i++) {
      for($j = 0; $j < $S; $j++) {
        if($word === $cardWords[$i][$j]) {
          // 正ならbingoと表示
          $cardWords[$i][$j] = "bingo";
        }
      }
    }
  }

  // カードにbingoがあるかどうかカウント
  $countBingo = [];
  for($i = 0; $i < $S; $i++) {
    if(in_array("hit", $cardWords[$i])) {
        array_push($countBingo, "yes");
    }
  }

  if(empty($countBingo)) {
  
  // カードにbingoがなければ終了
    echo "no";
  
  } else {
    // Bingoがあれば出力
  $output = [];

 // ビンゴの判定
 // 横
  for($i = 0; $i < $S; $i++) {
    $wordCount[] = array_count_values($cardWords[$i]);
    if($wordCount[$i]["bingo"] === $S) {
        array_push($output, "yes");
    }
  }
  unset($wordCount);

  
  // 縦
  $column = [];
  for($i = 0; $i < $S; $i++) {
    foreach ($cardWords as $word) {
  // 入れ替え
        $column[$i][] = $word[$i];
    }
    $wordCount[] = array_count_values($column[$i]);
  };
  
  foreach($wordCount as $count) {
    // 値が$S個のkeyがあるか
      if(array_keys($count, $S)) {
        array_push($output, "yes");
      }
    
  }
  unset($wordCount);

  // 左斜め
  for($i = 0, $j = 0; $i < $S; $i++, $j++) {
    $aboveLeft[$i] = $cardWords[$i][$j];
  };

  // bingoの数をカウント
  $wordCount = array_count_values($aboveLeft);
  if($wordCount["hit"] === $S) {
    array_push($output, "yes");
  }
  unset($wordCount);

  // 右斜め
  $aboveRight = [];
  for($i = 0, $j = $S - 1; $i < $S; $i++, $j--) {
    $aboveRight[$i] = $cardWords[$i][$j];
  };

  // bingoの数をカウント
  $wordCount = array_count_values($aboveRight);
  if($wordCount["hit"] === $S) {
    array_push($output, "yes");
  }
  unset($wordCount);

  // ビンゴかどうかの出力
  echo empty($output) ? "no" : "yes";

}

?>