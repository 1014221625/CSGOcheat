# Sample workflow for building and deploying a Jekyll site to GitHub Pages
name: Deploy Jekyll with GitHub Pages dependencies preinstalled
<?php
//此为示例PHP，可以修改为与您的数据库链接或者您也可以手动修改
//

$List = 
    array(
		"motd"=>"你好，欢迎来到我的源，这是在你使用我的源之后要注意的事项：\n1.本源会...", //当别人切换到你的源时，会显示的一条公告
        "motd_time"=>"10", //切换到你的源之后，要显示多少秒的公告，根据公告的字数酌情调整
		array(
            "name"=>"游戏1",
            "preview"=>"https://static.launchersu.net/custom_game.png",
            "processName"=>"game.exe",
            "gameid"=>"游戏的Steam AppID，选填,不需要请留空",
            "list"=> array(
				array(
					"name"=>"显示的名字",
					"descript"=>"描述",
					"lastupd"=>"最后更新日期",
					"dlurl"=>"下载链接",
					"disabled"=>"是否禁止加载,填写0或者1",
					"compressed"=>"指示dll是否被zlib压缩,填写0或者1",
					"MD5"=>"dll的MD5,用于下载校验,选填,不需要请留空"
				),
				array(
					"name"=>"My Cheat",
					"descript"=>"F1 - ESP\nF2 - AimBot\nF3 - Glow",
					"lastupd"=>"2022-1-1 00:00:00",
					"dlurl"=>"https://developer.lanzoug.com/file/?UjRbZV1sU2IACVFpBDFWOldoAztRRwJtBHNbMVRhUTMHblt4ACRVL1ZkADoBOVF2VGgAbAIxUzRRCQNsUmpbZ1JjWzxdNVM2AGdRMwRnVmBXOgMgUWgCcwQ+W2xUOVFiBzBbOQBvVTdWNABwASVRIFQzADcCbVNjUWUDKlI+W2lSfVs8XTdTKAAzUTQEYFY0VzgDZFE6AmEEO1tkVGtRaAdlWzgAZVUxVjMAbgFlUWJUOgAwAjhTZVEzA2BSaFs8UmNbOV1jU2YAeFFjBDxWO1crA3NRfQJlBHFbNFRsUW0HNVs5AGRVNFY1AGMBZ1F2VHoAbAIwUzRRMAM4Uj9bbFJlWzRdMVM+AGFRNwRjVmFXIwMoUSgCZgRvWypUNVFgByFbeQAtVXZWPQBnAWNRZ1Q2ADQCZFNkUW4DNFI5W3xSJ1tlXXBTOgBnUT8EY1Z5Vz8DN1E4Ai4EMFtkVCZRYgc0Wzk=",
					"disabled"=>"0",
					"compressed"=>"0",
					"MD5"=>""
				)
			)
        ),
        array(
            "name"=>"csgo",
            "preview"=>"https://static.launchersu.net/custom_game.png",
            "processName"=>"csgo.exe",
            "gameid"=>"730",
            "list"=> array(
				array(
					"name"=>"Glow Internal",
					"descirpt"=>"F1 - Glow\nF2 - AimBot",
					"lastupd"=>"2022-1-1 00:00:00",
					"dlurl"=>"https://developer.lanzoug.com/file/?UjRbZV1sU2IACVFpBDFWOldoAztRRwJtBHNbMVRhUTMHblt4ACRVL1ZkADoBOVF2VGgAbAIxUzRRCQNsUmpbZ1JjWzxdNVM2AGdRMwRnVmBXOgMgUWgCcwQ+W2xUOVFiBzBbOQBvVTdWNABwASVRIFQzADcCbVNjUWUDKlI+W2lSfVs8XTdTKAAzUTQEYFY0VzgDZFE6AmEEO1tkVGtRaAdlWzgAZVUxVjMAbgFlUWJUOgAwAjhTZVEzA2BSaFs8UmNbOV1jU2YAeFFjBDxWO1crA3NRfQJlBHFbNFRsUW0HNVs5AGRVNFY1AGMBZ1F2VHoAbAIwUzRRMAM4Uj9bbFJlWzRdMVM+AGFRNwRjVmFXIwMoUSgCZgRvWypUNVFgByFbeQAtVXZWPQBnAWNRZ1Q2ADQCZFNkUW4DNFI5W3xSJ1tlXXBTOgBnUT8EY1Z5Vz8DN1E4Ai4EMFtkVCZRYgc0Wzk=",
					"disabled"=>"0",
					"compressed"=>"0",
					"MD5"=>""
				)
			)
        )
    );

exit(json_encode($List, TRUE));
	
?>
on:
  # Runs on pushes targeting the default branch
  push:
    branches: ["main"]

  # Allows you to run this workflow manually from the Actions tab
  workflow_dispatch:

# Sets permissions of the GITHUB_TOKEN to allow deployment to GitHub Pages
permissions:
  contents: read
  pages: write
  id-token: write

# Allow one concurrent deployment
concurrency:
  group: "pages"
  cancel-in-progress: true

jobs:
  # Build job
  build:
    runs-on: ubuntu-latest
    steps:
      - name: Checkout
        uses: actions/checkout@v3
      - name: Setup Pages
        uses: actions/configure-pages@v3
      - name: Build with Jekyll
        uses: actions/jekyll-build-pages@v1
        with:
          source: ./
          destination: ./_site
      - name: Upload artifact
        uses: actions/upload-pages-artifact@v1

  # Deployment job
  deploy:
    environment:
      name: github-pages
      url: ${{ steps.deployment.outputs.page_url }}
    runs-on: ubuntu-latest
    needs: build
    steps:
      - name: Deploy to GitHub Pages
        id: deployment
        uses: actions/deploy-pages@v1
