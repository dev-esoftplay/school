// withHooks
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { memo } from 'react';

import React from 'react';
import { Image, Pressable, ScrollView, Text, TextInput, View } from 'react-native';
import SchoolColors from '../utils/schoolcolor';



export interface AuthForgotpassArgs {
  
}
export interface AuthForgotpassProps {
  
}
function m(props: AuthForgotpassProps): any {
  const schoolColors = new SchoolColors();
  return (
    <View style={{ flex:1 ,backgroundColor: "white",alignContent:'center'}}>
    <ScrollView style={{ flex: 1,paddingHorizontal: 30 }} showsVerticalScrollIndicator={false}>
    <Image source={require('/home/yasin/tmp/school/cgi-bin/mobile/assets/lupapass.png')}
        style={{ alignSelf: 'center', marginTop: 75 }} />
        <Text>
        Masukan Email anda untuk mengirim permintaan Password Kepada Admin dan kata sandi akan dikirim melalui email anda
        </Text>
        <View 
        style={{ flexDirection: "row", width: '100%', height: 50, backgroundColor: 'white', borderRadius: 10, marginTop: 10, paddingLeft: 10, opacity: 0.7, alignItems: 'center',borderColor:"black",borderWidth:2}} >
            <LibIcon.AntDesign name="user" size={25} color="gray" style={{ marginRight: 10 }} />
            <TextInput
              placeholder="Username"
              // clearTextOnFocus={true}

              // onChangeText={(text) => setUsername(text)}
            />
      </View>
      <Pressable style={{ width: '100%', height: 50, backgroundColor:schoolColors.primary, borderRadius: 10, marginTop: 10, opacity: 0.7, alignItems: 'center', justifyContent: 'center' }} >
        <Text style={{ fontSize: 18, fontWeight: 'bold' }}>Kirim Email</Text>
      </Pressable>
      <Text style={{ alignSelf: 'center', marginTop: 20 }}>{}</Text>
    </ScrollView>
    </View>
  )
}
export default memo(m);