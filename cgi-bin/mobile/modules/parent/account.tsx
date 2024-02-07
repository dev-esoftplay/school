// withHooks
import { LibDialog } from 'esoftplay/cache/lib/dialog/import';
// import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import navigation from 'esoftplay/modules/lib/navigation';
import { memo } from 'react';
import { MaterialIcons, Ionicons } from '@expo/vector-icons';
import React from 'react';
import { Image, Pressable, Text, View } from 'react-native';
import { Auth } from '../auth/login';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
// import { LibStyle } from 'esoftplay/cache/lib/style/import';


export interface ParentAccountArgs {

}
export interface ParentAccountProps {

}
function m(props: ParentAccountProps): any {
  const logout = () => {
    Auth.reset()
    navigation.navigate('auth/login')
  }
  return (
    <View style={{ flex: 1, backgroundColor: 'white' }}>

      <View style={{ flex: 1, backgroundColor: '#4B7AD6', borderBottomLeftRadius: 20, borderBottomRightRadius: 20, padding: 20 }}>
        <Text style={{ fontSize: 20, color: 'white', textAlign: 'center', fontWeight: 'bold' }}>Profil</Text>

        <View style={{ backgroundColor: '#FFFFFF', height: 120, justifyContent: 'flex-start', alignItems: 'center', marginVertical: 20, padding: 15, flexDirection: 'row', borderRadius: 10 }}>
          <Image source={require('../../assets/anies.png')} style={{ width: 95, height: 95, justifyContent: 'center' }} />
          <View style={{ marginLeft: 15, justifyContent: 'center', alignItems: 'flex-start' }}>
            <Text style={{ fontSize: 18, color: '#000000', textAlign: 'center', fontWeight: '600'}}>Anies Rasyid Baswedan</Text>
            <Text style={{ fontSize: 18, color: '#000000', textAlign: 'center', fontWeight: '600'}}>Presiden RI 2024</Text>
          </View>
        </View>
      </View>

      <View style={{ flex: 3 , backgroundColor: '',marginTop: 30, marginHorizontal: 15}}>
        <Pressable onPress={() => LibNavigation.navigate('parent/parentinfo')} style={{flexDirection:'row',alignItems:'center',backgroundColor:'#4B7AD6',borderRadius:12,height:55}}>
        <MaterialIcons name="person" size={35} color="#FFFFFF"  style={{marginLeft:15}} />
        <Text style={{fontSize:17,color:'#FFFFFF', marginLeft: 10}}>Informasi Personal</Text>
        </Pressable>

        <Pressable onPress={()=> LibNavigation.navigate('parent/parentnotif')} style={{flexDirection:'row',alignItems:'center',backgroundColor:'#4B7AD6',borderRadius:12,marginTop:30,height:55}}>
        <MaterialIcons name="notifications" size={35} color="#FFFFFF"  style={{marginLeft:15}} />
        <Text style={{fontSize:17,color:'#FFFFFF', marginLeft: 10}}>Notifikasi</Text>
        </Pressable>

        <Pressable onPress={()=>LibNavigation.navigate('parent/parenthelp')} style={{flexDirection:'row',alignItems:'center',backgroundColor:'#4B7AD6',borderRadius:12,marginTop:30,height:55}}>
        <MaterialIcons name="help" size={35} color="#FFFFFF"  style={{marginLeft:15}} />
        <Text style={{fontSize:17,color:'#FFFFFF', marginLeft: 10}}>Bantuan</Text>
        </Pressable>

        <Pressable onPress={()=>LibNavigation.navigate('parent/parentterms')} style={{flexDirection:'row',alignItems:'center',backgroundColor:'#4B7AD6',borderRadius:12,marginTop:30,height:55}}>
        <Ionicons name="newspaper" size={35} color="#FFFFFF"  style={{marginLeft:15}} />
        <Text style={{fontSize:17,color:'#FFFFFF', marginLeft: 10}}>Syarat dan Ketentuan</Text>
        </Pressable>

        <Pressable onPress={()=>logout()} style={{flexDirection:'row',alignItems:'center',backgroundColor:'#4B7AD6',borderRadius:12,marginTop:30,height:55}}>
        <MaterialIcons name="logout" size={35} color="#FFFFFF"  style={{marginLeft:15}} />
        <Text style={{fontSize:17,color:'#FFFFFF', marginLeft: 10}}>Keluar</Text>
        </Pressable>
      </View>
    </View>
  )
}
export default memo(m);