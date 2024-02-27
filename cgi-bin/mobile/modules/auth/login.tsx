// withHooks
import { LibCrypt } from 'esoftplay/cache/lib/crypt/import';
import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import { LibDialog } from 'esoftplay/cache/lib/dialog/import';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibPicture } from 'esoftplay/cache/lib/picture/import';
import { LibProgress } from 'esoftplay/cache/lib/progress/import';
import { LibUtils } from 'esoftplay/cache/lib/utils/import';
import { UserClass } from 'esoftplay/cache/user/class/import';
import esp from 'esoftplay/esp';
import useGlobalState from 'esoftplay/global';
import navigation from 'esoftplay/modules/lib/navigation';
import useSafeState from 'esoftplay/state';
import React from 'react';
import {
  Pressable,
  ScrollView,
  Text,
  TextInput,
  View
} from 'react-native';
import SchoolColors from '../utils/schoolcolor';

export interface LoginIndexsArgs { }
export interface LoginIndexsProps { }

export const Auth = useGlobalState(
  {
    username: '',
    password: '',
    status: '',
    apikey: '',
    isLogin: false,
  },
  { persistKey: 'auth', loadOnInit: true, isUserData: true, inFile: true }
);

//buat object untuk menampung respon dari api
export interface ResApi {
  id: string,
  name: string,
  email: string,
  apikey: string,
  group_ids: string[],
  teacher: {
    id: string,
    user_id: string,
    name: string,
    nip: string,
    phone: string,
    position: string,
    image: string,
    created: string,
    updated: string
  },
  course: string[],
  parent: string,


}



export default function m(props: LoginIndexsProps): any {

  const school = new SchoolColors();


  const [username, setUsername] = useSafeState('');
  const [password, setPassword] = useSafeState('');
  const [selectedIndex, setSelectedIndex] = useSafeState(true);


  function login(username?: string, password?: string) {
    LibUtils.getInstallationID().then((installation_id) => {

      const post = {
        username: new LibCrypt().encode(String(username || '55555')),
        password: new LibCrypt().encode(String(password || '20240101')),
        installation_id: installation_id
      }
      console.log("post", post) 
      // // console.log("username", username)
      // // console.log("password", password)
      LibProgress.show('Loading')
      new LibCurl('public_login', post, (result, msg) => {
        // // console.log("result", result)
        LibProgress.hide()
        // esp.log({ result, msg });
        console.log("result", result, typeof result)
        // UserClass berfungsi untuk menyimpan data user yang login
        UserClass.create(result).then((value) => {
          esp.log("disini", value);
          LibNavigation.reset()
        })
      }, (err) => {
        esp.log({ err });
        LibProgress.hide()
        // console.log("err", err)
        LibDialog.warning('Login Gagal', err?.message)
      }, 1)
    })
  }

  const showPassword = () => {
    return (
      <Pressable onPress={() => setSelectedIndex(!selectedIndex)}>
        {selectedIndex ? (
          <LibIcon.Feather
            name="eye"
            size={25}
            color="gray"
            style={{ marginLeft: 10 }}
          />
        ) : (
          <LibIcon.Feather
            name="eye-off"
            size={25}
            color="gray"
            style={{ marginLeft: 10 }}
          />
        )}
      </Pressable>
    );
  };

  return (
    <View style={{ flex: 1, backgroundColor: '#ffffff', alignContent: 'center' }}>
      <ScrollView
        style={{ flex: 1, paddingHorizontal: 30 }}
        showsVerticalScrollIndicator={false}
      >
        <LibPicture
          source={esp.assets('login.png')} resizeMode='contain'
          style={{ alignSelf: 'center', marginTop: 75, width: 300, height: 190 }}
        />
        <Text style={{ fontSize: 24, fontWeight: 'bold', marginTop: 20 }}>
          Selamat datang kembali!
        </Text>
        <Text>
          Masuk dan jadilah pengajar dan orang tua terbaik bagi siswa dan anak
          anda
        </Text>

        <View style={{ marginTop: 20 }} />
        <View
          style={{
            flexDirection: 'row',
            width: '100%',
            height: 50,
            backgroundColor: 'white',
            borderRadius: 10,
            marginTop: 10,
            paddingLeft: 10,
            opacity: 0.7,
            alignItems: 'center',
            borderColor: 'grey',
            borderWidth: 2,
          }}
        >
          <LibIcon.AntDesign
            name="user"
            size={25}
            color="gray"
            style={{ marginRight: 10 }}
          />
          <TextInput
            placeholder="Username"
            onChangeText={(text) => setUsername(text)}
          />
        </View>
        <View
          style={{
            flexDirection: 'row',
            width: '100%',
            height: 50,
            backgroundColor: 'white',
            borderRadius: 10,
            marginTop: 10,
            paddingHorizontal: 10,
            opacity: 0.7,
            alignItems: 'center',
            borderColor: 'grey',
            borderWidth: 2,
          }}
        >
          <LibIcon.EvilIcons
            name="lock"
            size={30}
            color="gray"
            style={{ marginRight: 10 }}
          />
          <TextInput
            placeholder="Password"
            secureTextEntry={selectedIndex}
            onChangeText={(text) => setPassword(text)}
          />
          <View style={{ flex: 1 }} />
          {showPassword()}
        </View>
        <View style={{ marginTop: 20 }} />
        <Pressable onPress={() => navigation.replace('auth/forgotpass')}>
          <Text
            style={{
              fontSize: 14,
              fontWeight: 'bold',
              alignSelf: 'flex-end',
              color: school.primary,
              textDecorationLine: 'underline',
            }}
          >
            Lupa Password?
          </Text>
        </Pressable>
        <View style={{ marginTop: 20 }} />
        <Pressable
          // onPress={()=>LibNavigation.navigate('teacher/index')}
          onPress={() => login(username, password)}
          style={{
            width: '100%',
            height: 50,
            backgroundColor: school.primary,
            borderRadius: 10,
            marginTop: 10,
            alignItems: 'center',
            justifyContent: 'center',
          }}
        >

          <Text style={{ fontSize: 20, fontWeight: 'bold', color: 'white' }}>
            Masuk
          </Text>
        </Pressable>
      </ScrollView>
    </View>
  );
}
