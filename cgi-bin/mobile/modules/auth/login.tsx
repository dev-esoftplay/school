// withHooks
import { EyeInvisibleOutlined, EyeOutlined } from '@ant-design/icons';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import navigation from 'esoftplay/modules/lib/navigation';
import { memo, useState } from 'react';

import React from 'react';
import { Image, Pressable, ScrollView, Text, TextInput, View } from 'react-native';
import { SafeAreaView } from 'react-native-safe-area-context';


export interface LoginIndexsArgs {

}
export interface LoginIndexsProps {

}
function m(props: LoginIndexsProps): any {
  // const [isLogin, setIsLogin] = Auth.useSelector(data => [data.isLogin, { persistKey: 'auth' }])
  const [username, setUsername] = useState('')
  const [password, setPassword] = useState('')
  const [selectedIndex, setSelectedIndex] = useState(true);
  const showpassword = () => {  
    if (selectedIndex == true) {
     
      return( 
      <Pressable onPress={() => { setSelectedIndex(false) }}>
            <LibIcon.Feather name="eye" size={25} color="gray" style={{ marginLeft: 10 }} />
        </Pressable>)
    } else {
      return( 
        <Pressable onPress={() => { setSelectedIndex(false) }}>
        <LibIcon.Feather name="eye-off" size={25} color="gray" style={{ marginLeft: 10 }} />
                </Pressable>)

    }
  }
  return (
    <View style={{ flex: 1, backgroundColor: '#fce40e', alignContent: 'center',  }}>
      <ScrollView style={{ flex: 1,paddingHorizontal: 30 }} showsVerticalScrollIndicator={false}>
      <Image source={require('/home/yasin/tmp/school/cgi-bin/mobile/assets/login.png')}
        style={{ alignSelf: 'center', marginTop: 75 }} />
      <Text style={{ fontSize: 24, fontWeight: 'bold', marginTop: 20 }}>Selamat datang kembali!</Text>
      <Text>Masuk dan jadilah pengajar dan orang tua
        terbaik bagi siswa dan anak anda</Text>
      
      <View style={{ marginTop: 20 }}/>
      <View style={{ flexDirection: "row", width: '100%', height: 50, backgroundColor: 'white', borderRadius: 10, marginTop: 10, paddingLeft: 10, opacity: 0.7, alignItems: 'center' }} >
            <LibIcon.AntDesign name="user" size={25} color="gray" style={{ marginRight: 10 }} />
            <TextInput
              placeholder="Username"
              // clearTextOnFocus={true}

              onChangeText={(text) => setUsername(text)}
            />
      </View>
      <View style={{ flexDirection: "row", width: '100%', height: 50, backgroundColor: 'white', borderRadius: 10, marginTop: 10, paddingHorizontal: 10, opacity: 0.7, alignItems: 'center' }} >
            <LibIcon.EvilIcons name="lock" size={30} color="gray" style={{ marginRight: 10 }} />
            <TextInput
              placeholder="Password"
             
              secureTextEntry={selectedIndex}
              onChangeText={(text) => setPassword(text)}
            />
            <View style={{flex:1}}/>
         {showpassword()}
      </View>
      <View style={{ marginTop: 20 }}/>
      <Pressable onPress={() => {navigation.replace('auth/forgotpass') }}>
        <Text style={{ fontSize: 14, fontWeight: 'bold', alignSelf: 'flex-end' }}>Lupa Password?</Text>
      </Pressable>
      <View style={{ width: '100%', height: 50, backgroundColor: '#f9c815', borderRadius: 10, marginTop: 10, alignItems: 'center', justifyContent: 'center' }} >
            <Text style={{ fontSize: 20, fontWeight: 'bold' }}>Masuk</Text>
      </View>
    
      </ScrollView>
    </View>
  )
}
export default memo(m);