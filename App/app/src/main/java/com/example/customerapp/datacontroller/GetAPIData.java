package com.example.customerapp.datacontroller;


import java.io.BufferedOutputStream;
import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.net.HttpURLConnection;
import java.net.URL;


public class GetAPIData{

    public static String getAPIData(String address) throws IOException{

        InputStream is = null;

        try{
            URL url = new URL(address);
            HttpURLConnection connection = (HttpURLConnection) url.openConnection();
            connection.setReadTimeout(15000);
            connection.setConnectTimeout(15000);
            connection.setRequestMethod("GET");
            connection.setDoInput(true);
            connection.connect();

            int responseCode = connection.getResponseCode();
            if (responseCode != 200){
                throw new IOException("Response code:" + responseCode);
            }

            is = connection.getInputStream();
            return readStream(is);
        } catch (IOException e){
            e.printStackTrace();
        } finally {
            if (is!= null){
                is.close();
            }
        }
        return null;
    }

    private static String readStream(InputStream stream) throws IOException{
        byte[] buffer = new byte[1024];
        ByteArrayOutputStream byteArray = new ByteArrayOutputStream();
        BufferedOutputStream out = null;
        try{
            int length;
            out = new BufferedOutputStream(byteArray);
            while((length = stream.read(buffer)) > 0){
                out.write(buffer, 0, length);
            }
            out.flush();
            return byteArray.toString();

        } catch (IOException e) {
            e.printStackTrace();
            return null;
        } finally {
            if (out != null){
                out.close();
            }
        }
    }





}
