// withHooks
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import navigation from 'esoftplay/modules/lib/navigation';
import { memo, useState } from 'react';

import React from 'react';
import { Image, Pressable, ScrollView, Text, TextInput, View } from 'react-native';
import SchoolColors from '../utils/schoolcolor';
import { UnderlineOutlined } from '@ant-design/icons';
import { LibDialog } from 'esoftplay/cache/lib/dialog/import';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import useGlobalState from 'esoftplay/global';


export interface LoginIndexsArgs {

}
export interface LoginIndexsProps {

}

export const Auth = useGlobalState({
  username: '',
  password: '',
  status: '',
  isLogin: false,
}, { persistKey: 'auth', loadOnInit: true, isUserData: true, inFile: true })

function m(props: LoginIndexsProps): any {
  const school = new SchoolColors();
  const [isLogin, ] = Auth.useSelector(data => [data.isLogin, { persistKey: 'auth' }])
  const [loginAs,] = Auth.useSelector(data => [data.status, { persistKey: 'auth' }])
  const [username, setUsername] = useState('')
  const [password, setPassword] = useState('')
  const [selectedIndex, setSelectedIndex] = useState(true);

  

  const login = (usernames: string, passwords: any) => {
    const data = {
      teacher: [
        {
          username: "Johnwick",
          password: "123456",
          status: "teacher",
          isLogin: true
        },
        {
          username: "Mary",
          password: "123456",
          status: "teacher",
          isLogin: true
        }
      ],
      parent: [
        {
          username: "david",
          password: "123456",
          status: "parent",
          isLogin: true
        },
        {
          username: "lisa",
          password: "123456",
          status: "parent",
          isLogin: true
        }
      ]
    };

    console.log("username: " + username + '\n' + "password: " + password)
    if (username == '' || password == '') {
      LibDialog.info("Warning", "Username or Password cannot be empty")
    } else if (usernames == data.teacher[1].username&& passwords == data.teacher[1].password) {
      Auth.set({ username: usernames, password: passwords, status: data.teacher[1].status, isLogin: true },)
      LibNavigation.replace('teacher/index')
    }
  
    else {
      LibDialog.info("Hint", "Username is" + " " + data.teacher[1].username + '\n' + "Password is" + " " + data.teacher[1].password + '\n' )

    }
  }
  if (isLogin == true && loginAs == "teacher") {
    LibNavigation.navigate('teacher/index')
  }

  const showpassword = () => {
    if (selectedIndex == true) {
      return (
        <Pressable onPress={() => { setSelectedIndex(false) }}>
          <LibIcon.Feather name="eye" size={25} color="gray" style={{ marginLeft: 10 }} />
        </Pressable>)
    } else {
      return (
        <Pressable onPress={() => { setSelectedIndex(false) }}>
          <LibIcon.Feather name="eye-off" size={25} color="gray" style={{ marginLeft: 10 }} />
        </Pressable>)

    }
  }
  return (
    <View style={{ flex: 1, backgroundColor: 'white', alignContent: 'center', }}>
      <ScrollView style={{ flex: 1, paddingHorizontal: 30 }} showsVerticalScrollIndicator={false}>
        <Image source={require('../../assets/login.png')}
          style={{ alignSelf: 'center', marginTop: 75 }} />
        <Text style={{ fontSize: 24, fontWeight: 'bold', marginTop: 20 }}>Selamat datang kembali!</Text>
        <Text>Masuk dan jadilah pengajar dan orang tua
          terbaik bagi siswa dan anak anda</Text>

        <View style={{ marginTop: 20 }} />
        <View style={{ flexDirection: "row", width: '100%', height: 50, backgroundColor: 'white', borderRadius: 10, marginTop: 10, paddingLeft: 10, opacity: 0.7, alignItems: 'center', borderColor: "grey", borderWidth: 2 }} >
          <LibIcon.AntDesign name="user" size={25} color="gray" style={{ marginRight: 10 }} />
          <TextInput
            placeholder="Username"
            // clearTextOnFocus={true}
            onChangeText={(text) => setUsername(text)}
          />
        </View>
        <View style={{ flexDirection: "row", width: '100%', height: 50, backgroundColor: 'white', borderRadius: 10, marginTop: 10, paddingHorizontal: 10, opacity: 0.7, alignItems: 'center', borderColor: "grey", borderWidth: 2 }} >
          <LibIcon.EvilIcons name="lock" size={30} color="gray" style={{ marginRight: 10 }} />
          <TextInput
            placeholder="Password"

            secureTextEntry={selectedIndex}
            onChangeText={(text) => setPassword(text)}
          />
          <View style={{ flex: 1 }} />
          {showpassword()}
        </View>
        <View style={{ marginTop: 20 }} />
        <Pressable onPress={() => { navigation.replace('auth/forgotpass') }}>
          <Text style={{ fontSize: 14, fontWeight: 'bold', alignSelf: 'flex-end', color: school.primary, textDecorationLine: 'underline', }}>Lupa Password?</Text>
        </Pressable>
        <View style={{ marginTop: 20 }} />
        <Pressable onPress={() => { login(username,password) }} style={{ width: '100%', height: 50, backgroundColor: school.primary, borderRadius: 10, marginTop: 10, alignItems: 'center', justifyContent: 'center' }} >
          <Text style={{ fontSize: 20, fontWeight: 'bold', color: "white" }}>Masuk</Text>
        </Pressable>

      </ScrollView>
    </View>
  )
}
export default memo(m);