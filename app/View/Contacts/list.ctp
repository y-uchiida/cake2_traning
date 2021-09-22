<table>
	<tr>
		<th>ID</th>
		<th>お名前</th>
		<th>性別</th>
		<th>メール</th>
		<th>種別</th>
		<th>内容</th>
		<th>編集</th>
		<th>削除</th>
	</tr>
<?php
$gen = ["m" => "男性", "f" => "女性"];
$contact_type = ["", "資料請求", "商品の試用", "お見積もり依頼(無料)", "パートナー応募", "採用について", "その他"];
foreach ($records as $record) {
    print("<tr>");
    print("<td>{$record['Contact']['id']}</td>");
    print("<td>{$record['Contact']['name']}</td>");
    print("<td>{$gen[$record['Contact']['gender']]}</td>");
    print("<td>{$record['Contact']['email']}</td>");
    print("<td>{$contact_type[$record['Contact']['contact_type']]}</td>");
    print("<td>{$record['Contact']['content']}</td>");
    print("<td><a href='/Contacts/edit/{$record['Contact']['id']}'><button>この内容を編集</button></a></td>");
    print("<td><a class='link_delete' href='/Contacts/delete/{$record['Contact']['id']}'><button>削除</button></a></td>");
    print("</tr>");
}
?>
<div>
	<p>
<?php
$prev = $page - 1;
$next = $page + 1;
if ($prev > 0) {
    print(" <a href='/Contacts/list/{$prev}'><button> < 前 </button></a> ");
}
print(" $page / $page_num ");
if ($next <= $page_num) {
    print("<a href='/Contacts/list/{$next}'><button> 次 >  </button></a> ");
}
?>
	</p>
</div>
</table>

<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', () => {
		let del_lnks = document.querySelectorAll('.link_delete')
		Array.prototype.forEach.call(del_lnks, elm => {
			elm.addEventListener('click', (e) => {
				let confirm = window.confirm("このお問い合わせを削除しますか？")
				if (confirm === false) {
					e.preventDefault()
					return false;
				}
			})
		})
	})
</script>