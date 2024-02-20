// withHooks
import { LibDialog } from 'esoftplay/cache/lib/dialog/import';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import navigation from 'esoftplay/modules/lib/navigation';

import React from 'react';
import { Image, Pressable, Text, View } from 'react-native';
import { Auth } from '../auth/login';
import { LibPicture } from 'esoftplay/cache/lib/picture/import';
import esp from 'esoftplay/esp';


export interface ParentAccountArgs {

}
export interface ParentAccountProps {

}
export default function m(props: ParentAccountProps): any {
  const logout = () => {
    Auth.reset()
    navigation.navigate('auth/login')
  }
  function shadows (value:number) {
    return{
      elevation: 3, // For Android
      shadowColor: '#000', // For iOS
      shadowOffset: { width: 1, height: 5 },
      shadowOpacity: 0.7,
      shadowRadius: value,
    }
  }
  return (
    <View style={{ flex: 1, backgroundColor: 'white' }}>

      <View style={{ flex: 1, backgroundColor: '#4B7AD6', borderBottomLeftRadius: 20, borderBottomRightRadius: 20, padding: 20 }}>
        <Text style={{ fontSize: 20, color: 'white', textAlign: 'center', fontWeight: 'bold' }}>Profil</Text>

        <View style={{ flexDirection: 'row', padding: 10, marginTop: 20 }}>
          <LibPicture source={esp.assets('anies.png')} style={{ width: 100, height: 100, borderRadius: 50, borderWidth: 5, borderColor: 'white', marginRight: 12 }} />
          <View style={{ justifyContent: 'center', alignItems: 'flex-start' }}>
            <Text style={{ fontSize: 20, color: 'white', textAlign: 'center' }}>Anies Rasyid Baswedan</Text>
            <Text style={{ fontSize: 20, color: 'white', textAlign: 'center' }}>Presiden RI 2024</Text>
          </View>
        </View>
      </View>

      <View style={{ flex: 3, backgroundColor: '',padding:20}}>
        <Pressable onPress={()=>LibDialog.info("anda",'TOLOL')} style={{flexDirection:'row',alignItems:'center',padding:20,backgroundColor:'#4B7AD6',borderRadius:12,height:80}}>
        <LibIcon.FontAwesome name="user-circle" size={50} color="white"  style={{marginRight:20}} />
        <Text style={{fontSize:20,color:'white'}}>Informasi Personal</Text>
        </Pressable>

        <Pressable onPress={()=>LibDialog.info("anda",'TOLOL')} style={{flexDirection:'row',alignItems:'center',padding:20,backgroundColor:'#4B7AD6',borderRadius:12,marginTop:30,height:80}}>
        <LibIcon.FontAwesome name="user-circle" size={50} color="white"  style={{marginRight:20}} />
        <Text style={{fontSize:20,color:'white'}}>Notif</Text>
        </Pressable>

        <Pressable onPress={()=>LibDialog.info("anda",'TOLOL')} style={{flexDirection:'row',alignItems:'center',padding:20,backgroundColor:'#4B7AD6',borderRadius:12,marginTop:30,height:80}}>
        <LibIcon.FontAwesome name="user-circle" size={50} color="white"  style={{marginRight:20}} />
        <Text style={{fontSize:20,color:'white'}}>Bantuan</Text>
        </Pressable>

        <Pressable onPress={()=>logout()} style={{flexDirection:'row',alignItems:'center',padding:20,backgroundColor:'#4B7AD6',borderRadius:12,marginTop:30,height:80}}>
        <LibIcon.FontAwesome name="user-circle" size={50} color="white"  style={{marginRight:20}} />
        <Text style={{fontSize:20,color:'white'}}>Keluar</Text>
        </Pressable>
      </View>
    </View>
  )
}