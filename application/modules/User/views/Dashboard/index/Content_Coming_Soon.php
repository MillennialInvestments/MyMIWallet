<style>                    
    .success-nk-block {
        text-align: center;
        padding: 40px 0;
    }
    .success-header {
        color: #1ee0ac;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-weight: 900;
        font-size: 40px;
        margin-bottom: 10px;
        }
        p {
        color: #404F5E;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-size:20px;
        margin: 0;
        }
    .success-checkmark {
        color: #1ee0ac;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
    }
    .success-card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
    }
</style>
<div class="nk-block success-nk-block">
    <div class="card success-card">
        <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
            <i class="checkmark success-checkmark">✓</i>
        </div>
        <h1 class="success-header">Content Coming Soon!</h1> 
        <p><?php echo $success_note; ?></p>
        <a class="btn btn-primary btn-md mt-3" href="<?php echo $success_link; ?>"><?php echo $success_btn; ?></a>
    </div>                
</div>