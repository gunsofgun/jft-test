<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simulasi JFT-Basic Nakayoshi Gakuin Center</title>
    <style>
        @page {
            margin: 0px;
        }

        html {
            margin: 0px
        }

        p {
            margin: 0;
        }

        body {
            font-family: "Noto Sans JP", sans-serif;
            font-optical-sizing: auto;
            font-weight: normal;
            font-style: normal;
            margin: 0;
        }

        .points {
            font-size: 10pt;
        }

        .card {
            border-style: solid;
            border-width: 1px;
            border-color: gray;
            border-radius: 5px;
        }

        .card-body {
            margin: 1rem;
        }

        .title {
            text-align: center;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0;
        }

        .table-bio {
            margin: auto;
        }

        /* table, td {
            border:1px solid black;
        } */

        .mt-3 {
            margin-top: 1.5rem;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        #myProgress {
            width: 100%;
            background-color: rgb(233, 233, 233);
            border-style: solid 1;
            border-radius: 10px;
        }

        #currBar {
            border-style: solid 0;
            border-radius: 10px;
            width: 75%;
            height: 20px;
            background-color: rgb(57, 191, 57);
            text-align: end;
            /* To center it horizontally (if you want) */
            color: white;
        }

        #myBar {
            border-style: solid 0;
            border-radius: 10px;
            height: 20px;
            background-color: green;
            text-align: end;
            /* To center it horizontally (if you want) */
            color: white;
        }

        #myBarA {
            border-style: solid 0;
            border-radius: 10px;
            width: 91%;
            height: 20px;
            background-color: green;
            text-align: end;
            /* To center it horizontally (if you want) */
            color: white;
        }

        #myBarB {
            border-style: solid 0;
            border-radius: 10px;
            width: 75%;
            height: 20px;
            background-color: green;
            text-align: end;
            /* To center it horizontally (if you want) */
            color: white;
        }

        #myBarC {
            border-style: solid 0;
            border-radius: 10px;
            width: 75%;
            height: 20px;
            background-color: green;
            text-align: end;
            /* To center it horizontally (if you want) */
            color: white;
        }

        #myBarD {
            border-style: solid 0;
            border-radius: 10px;
            width: 83%;
            height: 20px;
            background-color: green;
            text-align: end;
            /* To center it horizontally (if you want) */
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="title">
                    <h2>国際交流基金日本語基礎試験 合格通知書</h2>
                    <h2 class="mt-2">Japan Foundation Test for Basic Japanese Notification of Assessment Results</h2>
                </div>

                <div class="biodata mt-2">

                    <table class="table-bio">
                        <tr>
                            <td style="width: 20%">
                                <h6>名前</h6>
                                <h5>Name</h5>
                            </td>
                            <td style="width: 30%">
                                <p>: {{ $user->name }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20%">
                                <h6>Eメール</h6>
                                <h5>Email</h5>
                            </td>
                            <td style="width: 30%">
                                <p>: {{ $user->email }}</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="result mt-2">
                    <h4 class="japanese">あなたのテスト結果は次のとおりです</h4>
                    <h4 class="mt-2">Your test results are as follows.</h4>

                    <div class="card">
                        <div class="card-body">
                            <table class="points">
                                <tr>
                                    <td style="width: 10%;">
                                        <h4>合計スコア</h4>
                                    </td>
                                    <td style="width: 10%;">
                                        <h4>: {{ $total_point }} ポイント</h4>
                                    </td>

                                    <td style="width: 20%;"></td>

                                    <td style="width: 10%;">
                                        <p>スコアの範囲</p>
                                    </td>
                                    <td style="width: 10%;">
                                        <p>: 10 - 250 ポイント</p>
                                    </td>

                                    <td style="width: 20%;"></td>

                                    <td style="width: 10%;">
                                        <p>合格点</p>
                                    </td>
                                    <td style="width: 10%;">
                                        <p>: 200 ポイント</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4>Total Score</h4>
                                    </td>
                                    <td>
                                        <h4>Points</h4>
                                    </td>

                                    <td></td>

                                    <td>
                                        <p>Range of Scores</p>
                                    </td>
                                    <td>
                                        <p>Points</p>
                                    </td>

                                    <td></td>

                                    <td>
                                        <p>Passing Score</p>
                                    </td>
                                    <td>
                                        <p>Points</p>
                                    </td>
                                </tr>
                            </table>

                            <div class="range">
                                200
                                <div id="myProgress">
                                    <div id="currBar"></div>
                                </div>
                                {{ $total_point }}
                                <div id="myProgress">
                                    <div id="myBar" style="width: {{ ($total_point / 250) * 100 }}%"></div>
                                </div>
                            </div>

                            @dd($total_correct_section)

                            <p class="mt-3">
                                あなたは一定レベルの日本語能力に達していると評価されました国際交流基金基礎日本語能力試験
                            </p>
                            <p>
                                日常生活に支障がなく、ある程度の日常会話ができる。
                            </p>
                            <p>
                                You were assessed to have reached a level of Japanese Language proficiency in Japan
                                Foundation Test for Basic Japanese to be able to engage in everyday conversation to a
                                certain extent and without difficulties in daily life.
                            </p>

                            <p class="japanese mt-2">
                                各セクションの正答率は以下の通りです。
                            </p>
                            <p>
                                The percentage of correct answers for each section are as follows.
                            </p>

                            <table style="font-weight: bold; width: 100%;">
                                <tr>
                                    <td style="width: 50%;">
                                        <p class="japanese">脚本と語彙</p>
                                        <p>Script and Vocabulary</p>
                                    </td>
                                    <td style="width: 50%;">
                                        91%
                                        <div id="myProgress">
                                            <div id="myBarA"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">
                                        <p class="japanese">会話と表現</p>
                                        <p>Conversation and Expression</p>
                                    </td>
                                    <td style="width: 50%;">
                                        75%
                                        <div id="myProgress">
                                            <div id="myBarB"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">
                                        <p class="japanese">聞き取り</p>
                                        <p>Listening Comprehension</p>
                                    </td>
                                    <td style="width: 50%;">
                                        75%
                                        <div id="myProgress">
                                            <div id="myBarC"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">
                                        <p class="japanese">読解</p>
                                        <p>Reading Comprehension</p>
                                    </td>
                                    <td style="width: 50%;">
                                        83%
                                        <div id="myProgress">
                                            <div id="myBarD"></div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>