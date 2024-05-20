<?php

// test('routeページが正常に見えていること', function() {
// 	$this->get(route('entries.index'))->assertSuccessful();
// });

test('/hogeにアクセスしたら正常に見えていること', function() {
    $this->get(route('hoge'))->assertSuccessful();

});
