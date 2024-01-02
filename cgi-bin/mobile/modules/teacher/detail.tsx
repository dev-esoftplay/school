// withHooks
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import React from 'react';

import { memo } from 'react';
import { Image, Platform, View, Text, TouchableOpacity } from 'react-native';
import { MaterialIcons } from '@expo/vector-icons';

export interface TeacherDetailArgs {

}
export interface TeacherDetailProps {

}
function m(props: TeacherDetailProps): any {
    function elevation(value: any) {
        if (Platform.OS === "ios") {
            if (value === 0) return {};
            return { shadowColor: 'black', shadowOffset: { width: 0, height: value / 2 }, shadowRadius: value, shadowOpacity: 0.24 };
        }
        return { elevation: value };
    }
    return (
        <View style={{ justifyContent: 'center', alignItems: 'center', marginTop: 120, ...elevation(6) }}>

            <View style={{ justifyContent: 'flex-start', alignItems: 'flex-start', marginTop: 5 }}>
                <TouchableOpacity style={{ position: 'absolute', marginTop: -70, marginLeft: -185 }}>
                    <MaterialIcons name='arrow-back-ios' size={30} color='#000000' />
                </TouchableOpacity>
            </View>

            <Image source={{ uri: 'https://images.unsplash.com/photo-1507823782123-27db7f9fd196?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' }} style={{ width: 135, height: 135, borderRadius: 135 / 2, borderWidth: 3, borderColor: '#FFFFFF' }} />
            <View style={{ justifyContent: 'center', alignItems: 'center', marginTop: 10 }}>
                <Text style={{ color: '#000000', fontWeight: 'bold', fontSize: 25, textAlign: 'center', padding: 10 }}>Rocket Racoon, S.Ag, S.E, M.Pd, S.Pd</Text>
            </View>

                <View style={{ flexDirection: 'row', marginTop: 10, marginHorizontal: 20, }}>
                    <TouchableOpacity disabled={true} style={{ flex: 1, paddingVertical: 10, backgroundColor: '#136B93', justifyContent: 'center', alignItems: 'center', borderRadius: 10, marginRight: 10 }}>
                        <Text style={{ color: '#FFFFFF', fontSize: 15, fontWeight: 'bold' }}>Guru IPA</Text>
                    </TouchableOpacity>

                    <TouchableOpacity disabled={true} style={{ flex: 1, paddingVertical: 10, backgroundColor: '#136B93', justifyContent: 'center', alignItems: 'center', borderRadius: 10, marginLeft: 10 }}>
                        <Text style={{ color: '#FFFFFF', fontSize: 15, fontWeight: 'bold' }}>Wali Kelas 8A</Text>
                    </TouchableOpacity>
                </View>

            <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold',  marginBottom: 10 , marginTop:30, marginRight: 260, alignContent: 'flex-start', textAlign: 'left' }}>Email Pengajar</Text>
            <View style={{ width: '90%', height: 60, justifyContent: 'center', padding: 5, paddingHorizontal: 10, borderRadius: 8, elevation: 3, backgroundColor: '#fff', shadowColor: '#000', shadowOffset: { width: 1, height: 1 }, shadowOpacity: 0.3, shadowRadius: 2 }}> 
                <Text style={{ alignContent: 'flex-start', textAlign: 'left', color: '#898989' }}>rocketracoon@gmail.com</Text>
            </View>

            
            <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold',  marginBottom: 10, marginTop: 15, marginRight: 270, alignContent: 'flex-start', textAlign: 'left' }}>NIP Pengajar</Text>
            <View style={{ width: '90%', height: 60, justifyContent: 'center', padding: 5, paddingHorizontal: 10, borderRadius: 8, elevation: 3, backgroundColor: '#fff', shadowColor: '#000', shadowOffset: { width: 1, height: 1 }, shadowOpacity: 0.3, shadowRadius: 2 }}> 
                <Text style={{ alignContent: 'flex-start', textAlign: 'left', color: '#898989' }}>2983429834729210</Text>
            </View>

        </View>
    )
}
export default memo(m)