<!DOCTYPE html><html lang="en">
  <head>
   <title>Phases</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" href="/favicon.ico?v=1.1">

    <!-- jQuery and Bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>

    <!-- Livequery -->
    <script src="//raw.githack.com/hazzik/livequery/master/src/jquery.livequery.js"></script>
    
    <!-- App -->
    <script>
    window.app = {
        init: function() {
            // If URL or localStorage has saved data, then load
            app.persist.load.any();

        }, // init
        persist: {
            load: {
                any: function() {
                    // URL vs localStorage loading
                    var search = new URLSearchParams(window.location.search);
                    var urlData = search.get("data");
                    if(urlData) {
                        app.renderAll(urlData);
                    } else if(localStorage.getItem("phases__data")) {
                        var localStorageData = localStorage.getItem("phases__data");
                        app.renderAll(localStorageData);
                    }
                }
            },
            save: function(data) {
                history.pushState({}, "", "?data=" + JSON.stringify(data));
                localStorage.setItem("data", data);
            },
        },
        renderAll: function(data) {
            console.log(data);
            // TODO: ...
        }
    } // app

    $(function() {
        // Start app
        app.init();

        // Event handler on demand
        $(".msgs").livequery( (i, el)=>{
            $(el).on("keyup", function(ev) {
                app.persist.save();
            })
        });

        $(".shuffle").livequery( (i, el)=>{
            $(el).on("click", function(ev) {
                let $msgsWrapper = $(ev.target).closest(".msgs-wrapper"),
                    $msgs = $msgsWrapper.find(".msgs");

                let msgs_str = $msgs.val(), 
                    msgs = msgs_str.split('\n'),
                    shuffledMsgs = msgs.filter(msg=>msg.length>0).sort( () => .5 - Math.random() ),
                    shuffledMsgs_str = shuffledMsgs.join("\n");

                $msgs.val(shuffledMsgs_str);
                app.persist.save();
            })
        });

        $(".delete").livequery( (i, el)=>{
            $(el).on("click", function(ev) {
                let $msgsWrapper = $(ev.target).closest(".msgs-wrapper");
                
                $msgsWrapper.remove();
                app.persist.save();
            })
        });
    }); 
    </script>

    <style>
    textarea {
        resize: vertical;
    }
    button {
        cursor: pointer;
    }
    </style>
    
</head>
    <body>
        <div class="container">
            <header>
                <!-- Title, author, socials, description -->
                <div class="row">
                    <h1 class="site-title">Phases</h1>
                    <div class="author-line">
                        <b>By Weng Fei Fung</b>
                        <a class="px-1" href="https://www.youtube.com/channel/UCg1O9uttSv3ZBzd1iep25Ig/" target="_blank"><i class="fab fa-youtube"></i></a>
                        <a class="px-1" href="https://www.linkedin.com/in/weng-fung/" target="_blank"><i class="fab fa-linkedin"></i></a>
                        <a class="px-1" href="https://github.com/Siphon880gh/" target="_blank"><i class="fab fa-github"></i></a>
                    </div>
                    <p class="site-desc mt-2">Great for spaced repetition studying, guided meditation, etc. Play different lines at time intervals. Choose a section aka phase to have their lines play. Save/loads instantly.</p>
                </div>

                <!-- Add -->
                <nav class="site-buttons fs-6 row">
                    <div class="col col-x mb-4">
                        <button class="add"><i class="fa fa-plus-square"></i><span>&nbsp;Add</span></button>
                    </div>
                </nav>
            </header>
            <div class="row">
                <div class="msgs-wrapper col-md-2 border">
                    <textarea class="msgs"></textarea>
                    <nav class="msgs-buttons">
                        <button class="shuffle"><i class="fa fa-random"></i></button>
                        <button class="delete"><i class="fa fa-trash"></i></button>
                    </nav>
                </div>
            </div>
        </div><!-- container -->
        
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   
    </body>
</html>