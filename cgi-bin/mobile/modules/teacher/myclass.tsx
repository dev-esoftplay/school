// withHooks

import { MaterialIcons } from '@expo/vector-icons';
import React from 'react';
import { memo } from 'react';
import { View, Platform, Text } from 'react-native';
import { TouchableOpacity } from 'react-native-gesture-handler';


export interface TeacherMyClassArgs {
    
}
export interface TeacherMyClassProps {
    
}
function m(props: TeacherMyClassProps): any {
    function elevation(value: any) {
        if (Platform.OS === "ios") {
            if (value === 0) return {};
            return { shadowColor: '#000000', shadowOffset: { width: 0, height: value / 2 }, shadowRadius: value, shadowOpacity: 0.24}
        }
        return {elevation: value };
    }
    return (
    <View style={{ justifyContent: 'center', alignItems: 'center', marginTop: 60, ...elevation(6) }}>

        <View>
        <View style={{ justifyContent: 'flex-start', alignItems: 'flex-start' }}>
                <TouchableOpacity style={{ marginRight: 335 }}>
                    <MaterialIcons name='arrow-back-ios' size={30} color='#000000' />
                </TouchableOpacity>
            </View>
        </View>
        
        <View style={{ flexDirection: 'row', marginTop: 115 , marginHorizontal: 10 }}>
            <TouchableOpacity disabled={true} style={{ paddingVertical: 15, paddingHorizontal: 32, backgroundColor: '#136B93', justifyContent: 'center', alignItems: 'center', borderRadius: 10, marginRight: 1 }}>
                <Text style={{ color: '#FFFFFF', fontSize: 15, fontWeight: 'bold' }}>Jadwal Kelas</Text>
            </TouchableOpacity>

            <TouchableOpacity disabled={true} style={{ paddingVertical: 15, paddingHorizontal: 34, backgroundColor: '#19A7CE', justifyContent: 'center', alignItems: 'center', borderRadius: 10, marginLeft: 1 }}>
                <Text style={{ color: '#FFFFFF', fontSize: 15, fontWeight: 'bold' }}>Daftar Siswa</Text>
            </TouchableOpacity>
        </View>
    </View>
    )
}
export default memo(m)