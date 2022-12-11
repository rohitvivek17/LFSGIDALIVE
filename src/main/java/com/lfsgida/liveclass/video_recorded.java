package com.lfsgida.liveclass;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.MenuItem;
import android.webkit.WebChromeClient;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.TextView;

import com.google.android.material.bottomnavigation.BottomNavigationView;

public class video_recorded extends AppCompatActivity {
    public WebView recordedcontent;
    TextView tv;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_video_recorded);
        BottomNavigationView bottomNavigationView=findViewById(R.id.navigationview);
        bottomNavigationView.setOnNavigationItemSelectedListener(new BottomNavigationView.OnNavigationItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(@NonNull MenuItem item) {
                switch (item.getItemId()) {
                    case R.id.live:
                        startActivity(new Intent(getApplicationContext(), live_class.class));
                        overridePendingTransition(0, 0);
                        return true;
                    case R.id.dashboard:
                        startActivity(new Intent(getApplicationContext(), dashboard.class));
                        overridePendingTransition(0, 0);
                        return true;
                    case R.id.logout:
                        new Session_class(getApplicationContext()).Logout(getApplicationContext());
                        Intent intent=new Intent(getApplicationContext(),login.class);
                        intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK+Intent.FLAG_ACTIVITY_CLEAR_TOP);

                        startActivity(intent);
                        return true;
                }
                return false;
            }
        });
        recordedcontent=findViewById(R.id.videocontent);
        recordedcontent.setWebViewClient(new WebViewClient());
        recordedcontent.loadUrl("http://lfsgidaonline.com/wordpress/elearn/");
        recordedcontent.setWebChromeClient(new WebChromeClient());
        WebSettings webSettings=recordedcontent.getSettings();
        webSettings.setJavaScriptEnabled(true);
        webSettings.setPluginState(WebSettings.PluginState.ON);

    }
    @Override
    public void onBackPressed() {
        if(recordedcontent.canGoBack()){
            recordedcontent.goBack();
        }
        else {
            super.onBackPressed();
        }
    }
}