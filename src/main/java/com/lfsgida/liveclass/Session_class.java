package com.lfsgida.liveclass;

import android.content.Context;
import android.content.SharedPreferences;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class Session_class {
    SharedPreferences sharedPreferences;
    SharedPreferences.Editor editor;
    String Shared_Pref_Name = "Credentials";
    String Session_user_name_key = "user_Name";
    String Session_user_id_key = "user_id";
    String Session_user_class_key = "user_class";
    String Session_user_sec_key = "user_sec";

    public Session_class(Context context) {
        sharedPreferences = context.getSharedPreferences(Shared_Pref_Name, Context.MODE_PRIVATE);
        editor = sharedPreferences.edit();
    }

    public String SaveSession(Context context, String response) {
        String message = "Error";
        try {
            JSONObject jsonObject = new JSONObject(response);

            message = jsonObject.getString("message");
            if (message.equals("success")) {
                //Toast.makeText(login.this, response.toString(), Toast.LENGTH_SHORT).show();

                JSONArray jsonArray = jsonObject.getJSONArray("login");
                for (int i = 0; i < jsonArray.length(); i++) {
                    JSONObject object = jsonArray.getJSONObject(i);
                    String User_id = object.getString("user_id");
                    String User_class = object.getString("user_class");
                    String user_name = object.getString("user_name");
                    String user_sec = object.getString("user_sec");

                    editor.putString(Session_user_id_key, User_id);
                    editor.putString(Session_user_class_key, User_class);
                    editor.putString(Session_user_name_key, user_name);
                    editor.putString(Session_user_sec_key, user_sec);
                    editor.commit();
                }

            }
        } catch (JSONException e) {
            e.printStackTrace();

        }
        return message;
    }

    public int getSessionId() {
        if (sharedPreferences.contains(Session_user_id_key)) {
            return 1;
        } else
            return -1;
    }

    public void Logout(Context context) {
        String user_id = sharedPreferences.getString("user_id", "");

        editor.remove(Session_user_id_key);
        editor.remove(Session_user_class_key);
        editor.remove(Session_user_name_key);
        editor.remove(Session_user_sec_key);
        editor.commit();
        SetInDatabase(context, user_id);


    }

    public void SetInDatabase(Context context, String user_id) {
        String URL_LOGIN = "http://lfsgida.online//update.php";

        StringRequest stringRequest = new StringRequest(Request.Method.POST, URL_LOGIN,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        Toast.makeText(context.getApplicationContext(), response, Toast.LENGTH_SHORT).show();


                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(context.getApplicationContext(), error.toString(), Toast.LENGTH_LONG).show();
                    }
                }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                //Toast.makeText(context.getApplicationContext(), "hello"+ user_id, Toast.LENGTH_LONG).show();
                params.put("user_id", user_id);
                params.put("user_name", "vikas");

                return params;
            }
        };
        RequestQueue requestQueue = Volley.newRequestQueue(context.getApplicationContext());
        requestQueue.add(stringRequest);
    }

    public SharedPreferences getShare() {
        return sharedPreferences;
    }
}