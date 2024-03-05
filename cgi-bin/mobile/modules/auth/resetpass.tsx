// withHooks
import { useState } from 'react';

import { LibPicture } from 'esoftplay/cache/lib/picture/import';
import esp from 'esoftplay/esp';
import navigation from 'esoftplay/modules/lib/navigation';
import React from 'react';
import { Pressable, StyleSheet, Text, TextInput, View } from 'react-native';
import { ScrollView } from 'react-native-gesture-handler';
import SchoolColors from '../utils/schoolcolor';
const  schhol = new SchoolColors();

export interface AuthResetpassArgs {

}
export interface AuthResetpassProps {

}
export default function m(props: AuthResetpassProps): any {
  const [newpass, setnewpass] = useState('')
  const [confirmpass, setconfirmpass] = useState('')

  const check = (newpass: any, confirmpass: any) => {
    switch (newpass) {
      case confirmpass:
        return navigation.navigate('auth/login')
        break;
      default:
        return // console.log('password tidak sama')
        break;
    }

  }

  return (
    <View style={{ flex: 1 }} >
      <ScrollView showsVerticalScrollIndicator={false} style={{ padding: 30, alignContent: 'center' }}>
 
        <LibPicture source={esp.assets('phone.png')} style={{ width: 300, height: 190}}/>
        <Text style={{ fontSize: 16, textAlign: 'center', fontWeight: 'bold', marginTop: 20 }}>Masukkan kata sandi baru Anda</Text>
        <Text style={{ fontSize: 16, textAlign: 'center', }}>Jangan pernah memberikan kata sandi Anda kepada siapa pun, bahkan orang yang Anda percayai.</Text>
        {/* input newpass */}
        <View style={{ flexDirection: "row", width: '100%', height: 50, backgroundColor: 'white', borderRadius: 10, marginTop: 10, paddingLeft: 10, opacity: 0.7, alignItems: 'center' ,borderWidth: 1,borderColor:'gray'}} >
         
          <TextInput
            placeholder="sandi baru"
            onChangeText={(text) => setnewpass(text)}
          />
        </View>
        {/* inputconfirmpass */}
        <View style={{ flexDirection: "row", width: '100%', height: 50, backgroundColor: 'white', borderRadius: 10, marginTop: 10, paddingLeft: 10, opacity: 0.7, alignItems: 'center' ,borderColor: 'gray',borderWidth: 1,}} >
         
          <TextInput
            placeholder="Konfirmasi kata sandi"
            onChangeText={(text) => setconfirmpass(text)}
          />
        </View>
        {/* button change pass*/}
        <Pressable onPress={() => {navigation.navigate('auth/login')}} style={{ width: "100%",height:58,borderRadius:7,backgroundColor:schhol.primary,marginTop:30}}>
        <Text style={{color:'white',textAlign:'center',paddingTop:17,fontSize:16}}>Lanjutkan</Text>
        </Pressable>
      </ScrollView >
    </View>
  )
}
