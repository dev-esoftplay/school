// withHooks
import React from 'react';

import { memo } from 'react';

import { LibStyle } from 'esoftplay/cache/lib/style/import';
import { MaterialIcons } from '@expo/vector-icons';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { Image, Platform, View, Text, Pressable, TouchableOpacity } from 'react-native';


export interface TeacherProfileArgs {
    
}
export interface TeacherProfileProps {
    
}
function m(props: TeacherProfileProps): any {
    function elevation(value: any) {
        if (Platform.OS === "ios") {
            if (value === 0) return {};
            return { shadowColor: 'black', shadowOffset: { width: 0, height: value / 2 }, shadowRadius: value, shadowOpacity: 0.24};
        }
        return { elevation: value };
    }
    return (
        <View style={{ flex: 2, backgroundColor: '#FFFFFF', marginTop: LibStyle.STATUSBAR_HEIGHT }}>
            <View style={{ height: LibStyle.height / 2.5, backgroundColor: '#136B93', justifyContent: 'flex-start', alignItems: 'center', padding: 30, borderBottomLeftRadius: 40, borderBottomRightRadius: 40, ...elevation(6) }}>
                <Image source={{uri: 'https://images.unsplash.com/photo-1507823782123-27db7f9fd196?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'}} style={{ width: 135, height: 135, borderRadius: 135 / 2, borderWidth: 3, borderColor: '#FFFFFF' }} />
                <View>
                    <Text style={{ color: '#FFFFFF', fontWeight: 'bold', fontSize: 25, textAlign: 'center', padding: 10 }}>Rocket Racoon, S.Ag, S.E, M.Pd, S.Pd</Text>
                </View>

                <View style={{flexDirection: 'row', marginTop: 10, marginHorizontal: 20 }}>
                    <TouchableOpacity disabled={true} style={{ flex: 1, paddingVertical: 10, backgroundColor: '#FFFFFF', justifyContent: 'center', alignItems: 'center', borderRadius: 10, marginRight: 10 }}>
                        <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold' }}>Guru IPA</Text>
                    </TouchableOpacity>

                    <TouchableOpacity disabled={true}style={{flex: 1, paddingVertical: 10, backgroundColor: '#FFFFFF', justifyContent: 'center', alignItems: 'center', borderRadius: 10, marginLeft: 10 }}>
                        <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold' }}>Wali Kelas 8A</Text>
                    </TouchableOpacity>
                </View>
            </View>

            <View style={{ alignItems: 'center', marginTop: 25 }}>
            <Pressable onPress={()=>{LibNavigation.navigate('teacher/detail')}} style={{ height: 55, width: LibStyle.width - 25, backgroundColor: '#136B93', justifyContent: 'center', flexDirection: 'row' ,alignItems: 'center', borderRadius: 15 }}>
                    <Text style={{ color: '#FFFFFF', fontWeight: '400', fontSize: 18, marginRight: 285 }}>Profil</Text>
                    <MaterialIcons name= 'person' size={24} color='#FFFFFF'/>
            </Pressable>
            </View>

            <View style={{ alignItems: 'center', marginTop: 15 }}>
            <Pressable onPress={()=>{LibNavigation.navigate('teacher/myclass')}} style={{ height: 55, width: LibStyle.width - 25, backgroundColor: '#136B93', justifyContent: 'center', flexDirection: 'row', alignItems: 'center', borderRadius: 15  }}>
                    <Text style={{ color: '#FFFFFF', fontWeight: '400', fontSize: 18, marginRight: 260 }}>Kelasku</Text>
                    <MaterialIcons name= 'class' size={24} color='#FFFFFF'/>
            </Pressable>
            </View>

            <View style={{ alignItems: 'center', marginTop: 15 }}>  
            <Pressable onPress={()=>{LibNavigation.navigate('teacher/notifications')}} style={{ height: 55, width: LibStyle.width - 25, backgroundColor: '#136B93', justifyContent: 'center', flexDirection: 'row', alignItems: 'center', borderRadius: 15 }}>
                    <Text style={{ color: '#FFFFFF', fontWeight: '400', fontSize: 18, marginRight: 245 }}>Notifikasi</Text>
                    <MaterialIcons name= 'notifications' size={24} color='#FFFFFF'/>
            </Pressable>
            </View>

            <View style={{ alignItems: 'center', marginTop: 15 }}>
            <Pressable onPress={()=>{LibNavigation.navigate('teacher/password')}} style={{ height: 55, width: LibStyle.width - 25, backgroundColor: '#136B93', justifyContent: 'center', flexDirection: 'row', alignItems: 'center', borderRadius: 15 }}>
                    <Text style={{ color: '#FFFFFF', fontWeight: '400', fontSize: 18, marginRight: 180 }}>Ganti Kata Sandi</Text>
                    <MaterialIcons name='lock' size={24} color='#FFFFFF'/>
            </Pressable>
            </View>

            <View style={{ alignItems: 'center', marginTop: 15 }}>
            <Pressable onPress={()=>{LibNavigation.navigate('main/index')}} style={{ height: 55, width: LibStyle.width - 25, backgroundColor: '#136B93', justifyContent: 'center', flexDirection: 'row', alignItems: 'center', borderRadius: 15 }}>
                    <Text style={{ color: '#FFFFFF', fontWeight: '400', fontSize: 18, marginRight: 275 }}>Keluar</Text>
                    <MaterialIcons name='logout' size={24} color='#FFFFFF'/>
            </Pressable>
            </View>
            
        </View>
        
    )
}
export default memo(m);