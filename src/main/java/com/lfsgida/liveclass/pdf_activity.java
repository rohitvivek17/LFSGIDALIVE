package com.lfsgida.liveclass;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.app.DownloadManager;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.view.MenuItem;
import android.webkit.DownloadListener;
import android.webkit.WebChromeClient;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Toast;

import com.google.android.material.bottomnavigation.BottomNavigationView;

public class pdf_activity extends AppCompatActivity {
    private WebView notes;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_pdf);
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
        notes=findViewById(R.id.pdfnotes);
        notes.setWebViewClient(new WebViewClient());
        notes.loadUrl("http://lfsgidaonline.com/wordpress/download-pdf-file/");
        notes.setWebChromeClient(new WebChromeClient());
        WebSettings webSettings=notes.getSettings();
        webSettings.setJavaScriptEnabled(true);
        webSettings.setPluginState(WebSettings.PluginState.ON);
/// new... for downloading
        notes.setDownloadListener(new DownloadListener() {
            @Override
            public void onDownloadStart(String url, String userAgent, String contentDisposition, String mimetype, long contentLength) {
                DownloadManager.Request mRequest=new DownloadManager.Request(Uri.parse(url));
                mRequest.allowScanningByMediaScanner();
                mRequest.setNotificationVisibility(DownloadManager.Request.VISIBILITY_VISIBLE_NOTIFY_COMPLETED);
                DownloadManager myManager=(DownloadManager) getSystemService(DOWNLOAD_SERVICE);
                myManager.enqueue(mRequest);
                Toast.makeText(pdf_activity.this,"Your file is Downloading",Toast.LENGTH_SHORT).show();
            }
        });

    }
    @Override
    public void onBackPressed() {
        if(notes.canGoBack()){
            notes.goBack();
        }
        else {
            super.onBackPressed();
        }
    }
}