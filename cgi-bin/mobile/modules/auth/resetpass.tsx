// withHooks
import { memo, useState } from 'react';

import Scroll from 'esoftplay/modules/lib/scroll';
import React from 'react';
import { Image, Pressable, StyleSheet, Text, TextInput, View } from 'react-native';
import { ScrollView } from 'react-native-gesture-handler';
import { check } from 'esoftplay/modules/lib/updater';
import navigation from 'esoftplay/modules/lib/navigation';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import SchoolColors from '../utils/schoolcolor';
const  schhol = new SchoolColors();

export interface AuthResetpassArgs {

}
export interface AuthResetpassProps {

}
function m(props: AuthResetpassProps): any {
  const [newpass, setnewpass] = useState('')
  const [confirmpass, setconfirmpass] = useState('')

  const check = (newpass: any, confirmpass: any) => {
    switch (newpass) {
      case confirmpass:
        return navigation.navigate('auth/login')
        break;
      default:
        return console.log('password tidak sama')
        break;
    }

  }

  return (
    <View style={{ flex: 1 }} >
      <ScrollView showsVerticalScrollIndicator={false} style={{ padding: 30, alignContent: 'center' }}>
        <Image source={require('../../assets/phone.png')}
          style={styles.image} />
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

const styles = StyleSheet.create({
  container: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'center',
  },
  image: {
    width: 255,
    height: 255,
    top: 34,
    left: 52,
  },


});
export default memo(m);