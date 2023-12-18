// withHooks

import React from 'react';
import { Image, Text, View } from 'react-native';


export interface AuthOtpArgs {
  
}
export interface AuthOtpProps {
  
}
export default function m(props: AuthOtpProps): any {
  return (
    <View style={{flex:1 ,alignContent:'center'}}>
      <Image source={require('/home/yasin/tmp/school/cgi-bin/mobile/assets/otp.png')}
        style={{ alignSelf: 'center', marginTop: 75 }} />
      <Text style={{marginTop:30}}>
      Masukan OTP yang dikirim ke email anda untuk memperbarui kata sandi anda
      </Text>
      <View style={{ flexDirection: "row", width: '100%', height: 50, backgroundColor: 'white', borderRadius: 10, marginTop: 10, paddingLeft: 10, opacity: 0.7, alignItems: 'center' }} >
      
       
      
      </View>
    </View>
  )
}