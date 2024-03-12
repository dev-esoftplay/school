// withHooks
import { useEffect, useState } from 'react';
import { LibDialog } from 'esoftplay/cache/lib/dialog/import';
// import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import navigation from 'esoftplay/modules/lib/navigation';
import { MaterialIcons, Ionicons } from '@expo/vector-icons';
import React from 'react';
import { Image, Pressable, Text, View } from 'react-native';
import { Auth } from '../auth/login';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import { get } from 'react-native/Libraries/TurboModule/TurboModuleRegistry';
import { LibNotification } from 'esoftplay/cache/lib/notification/import';
import { UserClass } from 'esoftplay/cache/user/class/import';
import esp from 'esoftplay/esp';
// import { LibStyle } from 'esoftplay/cache/lib/style/import';
import { useTimeout } from 'esoftplay/timeout';

export interface ParentAccountArgs {

}
export interface ParentAccountProps {

}
function m(props: ParentAccountProps): any {


  const [Parent, setParent] = useState<any>([])

  const hitApi = () => { }

  function loadParent() {
    new LibCurl('parent', get, (result, msg) => {
      setParent(result)
    }, (err) => {
      console.log("error", err)
    }, 1)
  }

  useEffect(() => {
    loadParent();
  }, []);

  const data = UserClass.state().useSelector(s => s)
  async function apilogout(){
    console.log('menjalankan apilogout....');
    esp.mod("lib/notification").requestPermission((token) => {
        console.log('token :..==', token);
        // const data = UserClass.state().useSelector(s => s)

        const post = { token: token }


        new LibCurl('logout', null, (result, msg) => {
            console.log('check post', post);
            console.log('check apikey', data.apikey);
            console.log('check uri', data.uri);
            console.log('result', result);
            console.log('msg', msg);


        }, (error) => {
            console.log('check post', post);
            console.log('check apikey', data.apikey);
            console.log('check uri', data.uri);
            console.log("api logout error :", error);
            console.log('apilogout');

        }, 1)
    }
    )
}
const timeout = useTimeout()
  const logout = () => {
    console.log('menjalankan logout....');
    apilogout()
    timeout(() => {
        UserClass.pushToken()
        // pushToken()
        LibNotification.drop()
        Auth.reset()
        UserClass.delete()
        navigation.reset('auth/login')
    }, 1000)
  }
   

  return (
    <View style={{ flex: 1, backgroundColor: 'white' }}>

      <View style={{ flex: 1, backgroundColor: '#4B7AD6', borderBottomLeftRadius: 20, borderBottomRightRadius: 20, padding: 20, paddingTop: 40 }}>
        <Text style={{ fontSize: 20, color: 'white', textAlign: 'center', fontWeight: 'bold' }}>Profil</Text>

        <View style={{ backgroundColor: '#FFFFFF', height: 120, justifyContent: 'flex-start', alignItems: 'center', marginVertical: 20, padding: 15, flexDirection: 'row', borderRadius: 10 }}>
          <Image source={{ uri: Parent.image ?? 'https://images.unsplash.com/photo-1507823782123-27db7f9fd196?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' }} style={{ width: 105, height: 105, borderRadius: 135 / 2, borderWidth: 3, justifyContent: 'center' }} />
          <View style={{ marginLeft: 15, justifyContent: 'center', alignItems: 'flex-start' }}>
            <Text style={{ fontSize: 18, color: '#000000', textAlign: 'center', fontWeight: '600' }}>{Parent.name}</Text>
            <Text style={{ fontSize: 18, color: '#000000', textAlign: 'center', fontWeight: '600' }}>+{Parent.phone}</Text>
          </View>
        </View>
      </View>

      <View style={{ flex: 3, backgroundColor: '', marginTop: 30, marginHorizontal: 15 }}>
        <Pressable onPress={() => LibNavigation.navigate('parent/parentinfo')} style={{ flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center', backgroundColor: '#4B7AD6', borderRadius: 12, height: 55 }}>
          <Text style={{ fontSize: 17, color: '#FFFFFF', marginLeft: 15 }}>Profil Pribadi</Text>
          <MaterialIcons name="person" size={28} color="#FFFFFF" style={{ marginRight: 15 }} />
        </Pressable>

        {/* <Pressable onPress={() => LibNavigation.navigate('parent/parentnotif')} style={{ flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center', backgroundColor: '#4B7AD6', borderRadius: 12, marginTop: 30, height: 55 }}>
          <Text style={{ fontSize: 17, color: '#FFFFFF', marginLeft: 15 }}>Notifikasi</Text>
          <MaterialIcons name="notifications" size={28} color="#FFFFFF" style={{ marginRight: 15 }} />
        </Pressable> */}

        <Pressable onPress={() => LibNavigation.navigate('parent/parenthelp')} style={{ flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center', backgroundColor: '#4B7AD6', borderRadius: 12, marginTop: 30, height: 55 }}>
          <Text style={{ fontSize: 17, color: '#FFFFFF', marginLeft: 15 }}>Bantuan</Text>
          <MaterialIcons name="help" size={28} color="#FFFFFF" style={{ marginRight: 15 }} />
        </Pressable>

        <Pressable onPress={() => LibNavigation.navigate('parent/parentterms')} style={{ flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center', backgroundColor: '#4B7AD6', borderRadius: 12, marginTop: 30, height: 55 }}>
          <Text style={{ fontSize: 17, color: '#FFFFFF', marginLeft: 15 }}>Syarat dan Ketentuan</Text>
          <Ionicons name="newspaper" size={28} color="#FFFFFF" style={{ marginRight: 15 }} />
        </Pressable>

        <Pressable onPress={() => logout()} style={{ flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center', backgroundColor: '#4B7AD6', borderRadius: 12, marginTop: 30, height: 55 }}>
          <Text style={{ fontSize: 17, color: '#FFFFFF', marginLeft: 15 }}>Keluar</Text>
          <MaterialIcons name="logout" size={28} color="#FFFFFF" style={{ marginRight: 15 }} />
        </Pressable>
      </View>
    </View>
  )
}

export default memo(m);

function memo(m: (props: ParentAccountProps) => any) {
  throw new Error('Function not implemented.');
}
