// withHooks
import React from 'react';

import { memo } from 'react';

// import { LibStyle } from 'esoftplay/cache/lib/style/import';
import { MaterialIcons } from '@expo/vector-icons';
// import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { Image, Platform, View, Text, TouchableOpacity } from 'react-native';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
// import navigation from 'esoftplay/modules/lib/navigation';
// import { Auth } from '../auth/login';


export interface ParentInfoArgs {

}
export interface ParentInfoProps {

}
function m(props: ParentInfoProps): any {
    function elevation(value: any) {
        if (Platform.OS === "ios") {
            if (value === 0) return {};
            return { shadowColor: '#000000', shadowEffect: { width: 0, height: value / 2 }, shadowRadius: value, shadowOpacity: 0.24 };
        }
        return { elevation: value };
    }
    return (
        <View style={{ justifyContent: 'center', alignItems: 'center', marginTop: 70, ...elevation(6) }}>

            <View style={{ justifyContent: 'flex-start', alignItems: 'flex-start', marginTop: 5 }}>
                <TouchableOpacity onPress={() => LibNavigation.back()} style={{ position: 'absolute', marginTop: -40, marginLeft: -185 }}>
                    <MaterialIcons name='arrow-back-ios' size={30} color={'#000000'} />
                </TouchableOpacity>
            </View>

            <View style={{ justifyContent: 'center', marginTop: 10, marginBottom: 10 }}>
                <Image source={{ uri: 'https://images.unsplash.com/photo-1507823782123-27db7f9fd196?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' }} style={{ width: 165, height: 165, borderRadius: 165 / 2, borderWidth: 3, borderColor: '#FAFAFA', ...elevation(5) }}></Image>
                {/* <Text style={{ color: '#000000', fontWeight: 'bold', fontSize: 25, textAlign: 'center', padding: 10 }}>Rocket Racoon, S.Ag, S.E, M.Pd, S.Pd</Text> */}
            </View>

            <View style={{ justifyContent: 'center', flexDirection: 'row', marginTop: 10, marginHorizontal: 20, }}>
                <TouchableOpacity disabled={true} style={{ flex: 1, paddingVertical: 10, backgroundColor: '#4B7AD6', justifyContent: 'center', alignItems: 'center', borderRadius: 10, marginRight: 10 }}>
                    <Text style={{ color: '#FFFFFF', fontSize: 15, fontWeight: 'bold' }}>Data</Text>
                </TouchableOpacity>

                <TouchableOpacity disabled={true} style={{ flex: 1, paddingVertical: 10, backgroundColor: '#4B7AD6', justifyContent: 'center', alignItems: 'center', borderRadius: 10, marginRight: 10 }}>
                    <Text style={{ color: '#FFFFFF', fontSize: 15, fontWeight: 'bold' }}>Data</Text>
                </TouchableOpacity>
            </View>

            <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold', marginBottom: 10, marginTop: 15, marginRight: 320, alignContent: 'flex-start', textAlign: 'left' }}>Nama</Text>
            <View style={{ width: '90%', height: 60, justifyContent: 'center', padding: 5, paddingHorizontal: 10, borderRadius: 8, elevation: 3, backgroundColor: '#FFFFFF', shadowColor: '#000000', shadowOffset: { width: 1, height: 1 }, shadowOpacity: 0.3, shadowRadius: 2 }}>
                <Text style={{ alignContent: 'flex-start', textAlign: 'left', color: '#898989' }}>Rocket Racoon , S.Ag, S.E, M.Pd, S.Pd</Text>
            </View>

            <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold', marginBottom: 10, marginTop: 15, marginRight: 280, alignContent: 'flex-start', textAlign: 'left' }}>Nomor Telp</Text>
            <View style={{ width: '90%', height: 60, justifyContent: 'center', padding: 5, paddingHorizontal: 10, borderRadius: 8, elevation: 3, backgroundColor: '#FFFFFF', shadowColor: '#000000', shadowOffset: { width: 1, height: 1 }, shadowOpacity: 0.3, shadowRadius: 2 }}>
                <Text style={{ alignContent: 'flex-start', textAlign: 'left', color: '#898989' }}>08192382734293</Text>
            </View>

            <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold', marginBottom: 10, marginTop: 15, marginRight: 270, alignContent: 'flex-start', textAlign: 'left' }}>Tanggal Lahir</Text>
            <View style={{ width: '90%', height: 60, justifyContent: 'center', padding: 5, paddingHorizontal: 10, borderRadius: 8, elevation: 3, backgroundColor: '#FFFFFF', shadowColor: '#000000', shadowOffset: { width: 1, height: 1 }, shadowOpacity: 0.3, shadowRadius: 2 }}>
                <Text style={{ alignContent: 'flex-start', textAlign: 'left', color: '#898989' }}>14-32-1923</Text>
            </View>

            <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold', marginBottom: 10, marginTop: 15, marginRight: 320, alignContent: 'flex-start', textAlign: 'left' }}>Alamat</Text>
            <View style={{ width: '90%', height: 60, justifyContent: 'center', padding: 5, paddingHorizontal: 10, borderRadius: 8, elevation: 3, backgroundColor: '#FFFFFF', shadowColor: '#000000', shadowOffset: { width: 1, height: 1 }, shadowOpacity: 0.3, shadowRadius: 2 }}>
                <Text style={{ alignContent: 'flex-start', textAlign: 'left', color: '#898989' }}>Jalan Sebelah Kanan Lurus Dikit Terus Belok Atas</Text>
            </View>
        </View>
    )
}
export default memo(m);