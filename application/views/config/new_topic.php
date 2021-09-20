<div id="main">
	<div class="container">

		<div class="titlelists">
			<div class="titlelist-title"><h2><?php if(empty($id)){ ?>新しいお題の作成<?php }else{ ?>お題の編集<?php } ?></h2></div>
			<div class="message_a titlelist-data">* 必須項目</div>
		</div>
		<form method="post" action="admin_preview.php" accept-charset="UTF-8" enctype="multipart/form-data" class="form-horizontal" id="post_form">
			<div class="form-group">
				<label for="input_title" class="col-sm-3 control-label">タイトル<span class="message_a">*</span></label>
				<div class="col-sm-9">
					<input type="text" name="TITLE" id="input_title" class="form-control"
						   value="<?php if(!empty($id)){echo h($topic['title']);} ?>" >
				</div>
			</div>
			<div class="form-group">
				<label for="input_body" class="col-sm-3 control-label">本文<span class="message_a">*</span></label>
				<div class="col-sm-9">
					<textarea wrap="soft" name="BODY" id="input_body" class="form-control" rows="5"><?php if(!empty($id)){echo $topic['content'];} ?></textarea>
				</div>
				<div class="col-sm-offset-3 col-sm-9">
					<p class="help-block">本文にはHTMLタグが使用できます。</p>
				</div>
			</div>
			<div class="form-group">
				<label for="topic_img" class="col-sm-3 control-label">画像</label>
				<div class="col-sm-9">
					<div class="imgInput">
						<input type="file" id="topic_img" name="TOPIC_IMG">
						<div class="file_input input-group">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button" id="file_select">
									<span class="glyphicon glyphicon-folder-open select_button"></span>
								</button>
							</span>
							<input id="dummy_file" type="text" class="form-control" placeholder="ファイルを選択" disabled>
						</div>
						<?php if($topic['img']){$base64 = base64_encode($topic['img']);echo"<p><img src='data:image/".$topic['ext'].";base64,".$base64."' class='img_preview' /></p>";} ?>
					</div>
					<div class="imgClear">
						<input type="button" id="clear" value="ファイルをクリアする" class="btn btn-default">
					</div>
				</div>
				<div class="col-sm-offset-3 col-sm-9">
					<p class="help-block">画像は本文の上に挿入されます。GIF・JPG・PNGに対応。</p>
				</div>
			</div>
			<div class="form-group">
				<label for="input_vote_date" class="col-sm-3 control-label">投稿締め切り<span class="message_a topic_auto" <?php if($topic['topic_format'] != 0){echo"style='display:none'";} ?>>*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="input_vote_date" name="TOPIC_VOTE_DATE"
						   value="<?php if(!empty($id) and $topic['topic_vote_date'] != "0000-00-00 00:00:00"){echo date("Y/m/d H:i", strtotime($topic['topic_vote_date']));} ?>" />
				</div>
			</div>
			<div class="form-group">
				<label for="input_result_date" class="col-sm-3 control-label">採点締め切り<span class="message_a topic_auto" <?php if($topic['topic_format'] != 0){echo"style='display:none'";} ?>>*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="input_result_date" name="TOPIC_RESULT_DATE"
						   value="<?php if(!empty($id) and $topic['topic_result_date'] != "0000-00-00 00:00:00"){echo date("Y/m/d H:i", strtotime($topic['topic_result_date']));} ?>" />
				</div>
			</div>
			<div class="form-group">
				<label for="topic_type" class="col-sm-3 control-label">お題の形式</label>
				<div class="col-sm-9">
					<div id="mode" class="btn-group" data-toggle="buttons">
						<label class="btn btn-default <?php if(empty($id) or $topic['topic_type'] == normal){echo "active";} ?>">
							<input type="radio" value="normal" name="TOPIC_TYPE"
								<?php if(empty($id) or $topic['topic_type'] == normal){echo "checked";} ?>>普通</label>

						<label class="btn btn-default <?php if($topic['topic_type'] == line){echo "active";} ?>">
							<input type="radio" value="line" name="TOPIC_TYPE"
								<?php if($topic['topic_type'] == line){echo "checked";} ?>>穴埋め・ひと言</label>
					</div>
				</div>
			</div>
			<section id="topic_anaume_box" <?php if(empty($id) or $topic['topic_type'] == normal){echo"style='display:none'";} ?>>
				<div class="form-group">
					<label for="anaume_front" class="col-sm-3 control-label">前方に挿入</label>
					<div class="col-sm-9">
						<input type="text" name="ANAUME_FRONT" id="anaume_front"
							   class="form-control" value="<?php if(!empty($id)){echo h($topic['anaume_front']);} ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="anaume_rear" class="col-sm-3 control-label">後方に挿入</label>
					<div class="col-sm-9">
						<input type="text" name="ANAUME_REAR" id="anaume_rear"
							   class="form-control" value="<?php if(!empty($id)){echo h($topic['anaume_rear']);} ?>">
					</div>
					<div class="col-sm-offset-3 col-sm-9">
						<p class="help-block">穴埋めお題で回答の前後に挿入して表示します。</p>
					</div>
				</div>
			</section>

			<div class="panel-group" id="accordion">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">詳細設定</a>
						</h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="form-group">
								<label for="input_post_date" class="col-sm-3 control-label">投稿開始日時</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="input_post_date" name="TOPIC_POST_DATE"
										   value="<?php if(!empty($id) and $topic['topic_post_date'] != "0000-00-00 00:00:00"){echo date("Y/m/d H:i", strtotime($topic['topic_post_date']));} ?>" />
								</div>
								<div class="col-sm-offset-3 col-sm-9">
									<p class="help-block">入力された日時以前の場合、準備中になります。</p>
								</div>
							</div>
							<div class="form-group">
								<label for="topic_format" class="col-sm-3 control-label">表示の切り替え</label>
								<div class="col-sm-9">
									<div id="mode" class="btn-group" data-toggle="buttons">
										<label class="btn btn-default <?php if(empty($id) or $topic['topic_format'] == 0){echo "active";} ?>">
											<input type="radio" value="0" name="TOPIC_FORMAT"
												<?php if(empty($id) or $topic['topic_format'] == 0){echo "checked";} ?>>自動</label>
										<label class="btn btn-default <?php if($topic['topic_format'] == 1 ){echo "active";} ?>">
											<input type="radio" value="1" name="TOPIC_FORMAT"
												<?php if($topic['topic_format'] ){echo "checked";} ?>>投稿</label>
										<label class="btn btn-default <?php if($topic['topic_format'] == 2){echo "active";} ?>">
											<input type="radio" value="2" name="TOPIC_FORMAT"
												<?php if($topic['topic_format'] == 2){echo "checked";} ?>>採点</label>
										<label class="btn btn-default <?php if($topic['topic_format'] == 3){echo "active";} ?>">
											<input type="radio" value="3" name="TOPIC_FORMAT"
												<?php if($topic['topic_format'] == 3){echo "checked";} ?>>結果</label>
										<label class="btn btn-default <?php if($topic['topic_format'] == 4){echo "active";} ?>">
											<input type="radio" value="4" name="TOPIC_FORMAT"
												<?php if($topic['topic_format'] == 4){echo "checked";} ?>>準備</label>
										<label class="btn btn-default <?php if($topic['topic_format'] == 5){echo "active";} ?>">
											<input type="radio" value="5" name="TOPIC_FORMAT"
												<?php if($topic['topic_format'] == 5){echo "checked";} ?>>掲示</label>
										<label class="btn btn-default <?php if($topic['topic_format'] == 6){echo "active";} ?>">
											<input type="radio" value="6" name="TOPIC_FORMAT"
												<?php if($topic['topic_format'] == 6){echo "checked";} ?>>凍結</label>
									</div>
								</div>
								<div class="col-sm-offset-3 col-sm-9">
									<p class="help-block">手動で切り替える場合は自動以外を選択してください。</p>
								</div>
							</div>
							<div class="form-group">
								<label for="deadline" class="col-sm-3 control-label">締め切り</label>
								<div class="col-sm-9">
									<input type="text" name="DEADLINE" id="deadline"
										   class="form-control" value="<?php if(!empty($id)){echo h($topic['deadline']);} ?>">
								</div>
								<div class="col-sm-offset-3 col-sm-9">
									<p class="help-block">表示を手動で切り替える場合、締め切りとして表示される情報です。（例：「未定」「１０人集まるまで」など）</p>
								</div>
							</div>
							<div class="form-group">
								<label for="post_limit" class="col-sm-3 control-label">投稿採用数</label>
								<div class="col-sm-9">
									<input type="text" name="POST_LIMIT" id="post_limit" class="form-control onlynum"
										   value="<?php if(!empty($id)){echo h($topic['post_limit']);}else{echo"2";} ?>">
								</div>
								<div class="col-sm-offset-3 col-sm-9">
									<p class="help-block">１人がこの数を超えて回答を投稿をした場合、この個数分だけの最新の投稿が記録されます。空欄か0の場合は無制限です。</p>
								</div>
							</div>
							<div class="form-group">
								<label for="point_a" class="col-sm-3 control-label">点数Aの値<span class="message_a">*</span></label>
								<div class="col-sm-9">
									<input type="text" name="POINT_A" id="point_a"
										   class="form-control onlynum" placeholder="点数Aは入力必須です"
										   value="<?php if(!empty($id)){echo h($topic['point_a']);}else{echo"4";} ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="point_b" class="col-sm-3 control-label">点数Bの値</label>
								<div class="col-sm-9">
									<input type="text" name="POINT_B" id="point_b"
										   class="form-control onlynum"
										   value="<?php if(!empty($id)){echo h($topic['point_b']);}else{echo"3";} ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="point_c" class="col-sm-3 control-label">点数Cの値</label>
								<div class="col-sm-9">
									<input type="text" name="POINT_C" id="point_c"
										   class="form-control onlynum"
										   value="<?php if(!empty($id)){echo h($topic['point_c']);}else{echo"2";} ?>">
								</div>
								<div class="col-sm-offset-3 col-sm-9">
									<p class="help-block">採点で使用する点数の値。点数B・Cは空欄か0の場合は使用しません。</p>
								</div>
							</div>
							<div class="form-group">
								<label for="point_a_limit" class="col-sm-3 control-label">点数Aの制限数</label>
								<div class="col-sm-9">
									<input type="text" name="POINT_A_LIMIT" id="point_a_limit"
										   class="form-control onlynum"
										   value="<?php if(!empty($id)){echo h($topic['point_a_limit']);} ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="point_b_limit" class="col-sm-3 control-label">点数Bの制限数</label>
								<div class="col-sm-9">
									<input type="text" name="POINT_B_LIMIT" id="point_b_limit"
										   class="form-control onlynum"
										   value="<?php if(!empty($id)){echo h($topic['point_b_limit']);} ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="point_c_limit" class="col-sm-3 control-label">点数Cの制限数</label>
								<div class="col-sm-9">
									<input type="text" name="POINT_C_LIMIT" id="point_c_limit"
										   class="form-control onlynum"
										   value="<?php if(!empty($id)){echo h($topic['point_c_limit']);} ?>">
								</div>
								<div class="col-sm-offset-3 col-sm-9">
									<p class="help-block">一回の採点で点数A・B・Cを使用することが可能な数。空欄か0の場合は制限されません。</p>
								</div>
							</div>
							<div class="form-group">
								<label for="multiple_point" class="col-sm-3 control-label">点数の重複</label>
								<div class="col-sm-9">
									<div id="mode" class="btn-group" data-toggle="buttons">
										<label class="btn btn-default <?php if(!empty($id) and $topic['multiple_point'] ){echo "active";} ?>">
											<input type="radio" value="1" name="MULTIPLE_POINT"
												<?php if(!empty($id) and $topic['multiple_point'] ){echo "checked";} ?>>承諾</label>
										<label class="btn btn-default <?php if(empty($id) or empty($topic['multiple_point'])){echo "active";} ?>">
											<input type="radio" value="" name="MULTIPLE_POINT"
												<?php if(empty($id) or empty($topic['multiple_point'])){echo "checked";} ?>>拒否</label>
									</div>
								</div>
								<div class="col-sm-offset-3 col-sm-9">
									<p class="help-block">１つの回答に複数の点数をつけて投票できるかの設定です。承諾の場合、例えば１つの回答に4点・3点の両方にチェックをつけて合計7点をつけることが可能です。</p>
								</div>
							</div>
							<div class="form-group">
								<label for="comment_accept" class="col-sm-3 control-label">コメントの受付</label>
								<div class="col-sm-9">
									<div id="mode" class="btn-group" data-toggle="buttons">
										<label class="btn btn-default <?php if(empty($id) or $topic['comment_accept'] == 0){echo "active";} ?>">
											<input type="radio" value="0" name="COMMENT_ACCEPT"
												<?php if($topic['comment_accept'] == 0){echo "checked";} ?>>常に受付</label>
										<label class="btn btn-default <?php if($topic['comment_accept'] == 1){echo "active";} ?>">
											<input type="radio" value="1" name="COMMENT_ACCEPT"
												<?php if($topic['comment_accept'] == 1){echo "checked";} ?>>採点中のみ受付</label>
										<label class="btn btn-default <?php if($topic['comment_accept'] == 2){echo "active";} ?>">
											<input type="radio" value="2" name="COMMENT_ACCEPT"
												<?php if($topic['comment_accept'] == 2){echo "checked";} ?>>結果中のみ受付</label>
										<label class="btn btn-default <?php if($topic['comment_accept'] == 3){echo "active";} ?>">
											<input type="radio" value="3" name="COMMENT_ACCEPT"
												<?php if($topic['comment_accept'] == 3){echo "checked";} ?>>常に禁止</label>
									</div>
								</div>
								<div class="col-sm-offset-3 col-sm-9">
									<p class="help-block">各回答の詳細ページからコメントの入力を受け付けるかの設定です。</p>
								</div>
							</div>
							<div class="form-group">
								<label for="vote_bonus" class="col-sm-3 control-label">採点ボーナス</label>
								<div class="col-sm-9">
									<input type="text" name="VOTE_BONUS" id="vote_bonus"
										   class="form-control onlynum"
										   value="<?php if(!empty($id)){echo h($topic['vote_bonus']);} ?>">
								</div>
								<div class="col-sm-offset-3 col-sm-9">
									<p class="help-block">採点に参加した投稿者の回答に加算される点数です。空欄か0の場合は無し。</p>
								</div>

							</div>
							<div class="form-group">
								<label for="self_recommendation" class="col-sm-3 control-label">自薦</label>
								<div class="col-sm-9">
									<div id="mode" class="btn-group" data-toggle="buttons">
										<label class="btn btn-default <?php if(!empty($id) and $topic['self_recommendation'] ){echo "active";} ?>">
											<input type="radio" value="1" name="SELF_RECOMMENDATION"
												<?php if(!empty($id) and $topic['self_recommendation'] ){echo "checked";} ?>>承諾</label>
										<label class="btn btn-default <?php if(empty($id) or empty($topic['self_recommendation'])){echo "active";} ?>">
											<input type="radio" value="" name="SELF_RECOMMENDATION"
												<?php if(empty($id) or empty($topic['self_recommendation'])){echo "checked";} ?>>拒否</label>
									</div>
								</div>
								<div class="col-sm-offset-3 col-sm-9">
									<p class="help-block">自分の回答への投票の可否です。</p>
								</div>
							</div>
							<div class="form-group">
								<label for="report_rank" class="col-sm-3 control-label">採点期間の順位</label>
								<div class="col-sm-9">
									<div id="mode" class="btn-group" data-toggle="buttons">
										<label class="btn btn-default <?php if(empty($id) or !empty($topic['report_rank'])){echo "active";} ?>">
											<input type="radio" value="1" name="REPORT_RANK"
												<?php if(empty($id) or !empty($topic['report_rank'])){echo "checked";} ?>>表示する</label>
										<label class="btn btn-default <?php if(!empty($id) and empty($topic['report_rank'])){echo "active";} ?>">
											<input type="radio" value="" name="REPORT_RANK"
												<?php if(!empty($id) and empty($topic['report_rank'])){echo "checked";} ?>>表示しない</label>
									</div>
								</div>
								<div class="col-sm-offset-3 col-sm-9">
									<p class="help-block">採点期間中にページ下部に現在の順位表を表示するかの設定です。</p>
								</div>
							</div>
							<div class="form-group">
								<label for="public_vote" class="col-sm-3 control-label">採点者の公開</label>
								<div class="col-sm-9">
									<div id="mode" class="btn-group" data-toggle="buttons">
										<label class="btn btn-default <?php if(empty($id) or $topic['public_vote'] ){echo "active";} ?>">
											<input type="radio" value="1" name="PUBLIC_VOTE"
												<?php if(empty($id) or $topic['public_vote'] ){echo "checked";} ?>>公開</label>
										<label class="btn btn-default <?php if(!empty($id) and empty($topic['public_vote'])){echo "active";} ?>">
											<input type="radio" value="" name="PUBLIC_VOTE"
												<?php if(!empty($id) and empty($topic['public_vote'])){echo "checked";} ?>>非公開</label>
									</div>
								</div>
								<div class="col-sm-offset-3 col-sm-9">
									<p class="help-block">各回答に誰が何点つけたかを結果で公開します。</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
