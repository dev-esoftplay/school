// withHooks
import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import useSafeState from 'esoftplay/state';
import React, { useEffect } from 'react';
import { FlatList, Pressable, Text, View } from 'react-native';


export interface AttendReportStudentArgs {

}
export interface AttendReportStudentProps {

}
export default function m(props: AttendReportStudentProps): any {
  // get data from previous screen
  //<Pressable onPress={() => LibNavigation.navigate('teacher/attendeport_student', { idclas: item?.class?.id, date: dates ,schedule_id:item.schedule_id})}> 
  const schadule_id: string = LibNavigation.getArgsAll(props).schedule_id;
  const date: string = LibNavigation.getArgsAll(props).date;
  const idclass: string = LibNavigation.getArgsAll(props).idclas;
  const url = LibNavigation.getArgsAll(props).url

  useEffect(() => {
    console.log('url', url)
    console.log('idclass', idclass)
    let defaultUrl = "student_class?class_id=" + idclass + "&schedule_id=" + schadule_id + "&date=" + date
    let urls =  idclass!=null||undefined ?defaultUrl : url
    console.log('urls', urls)
    new LibCurl(urls, null,
      (result) => {
        console.log('Jadwal Result:', result);
        setStudentAttandenceApi(result)
        setstudentListAttandence(result.student_list)
        setMappedData(result);
      },
      (err) => {
        console.log("error", err)
      }, 1)


  }, [])

  // get student attandence data
  const [StudentAttandence, setStudentAttandenceApi] = useSafeState<any>();
  const [studentListAttandence, setstudentListAttandence,] = useSafeState(StudentAttandence?.student_list ?? [])


  //time

  let timeStart = StudentAttandence?.clock_start ?? ''
  let timeEnd = StudentAttandence?.clock_end ?? ''
  let time: string = timeStart + " - " + timeEnd

  // Utils
  let [mappedData, setMappedData] = useSafeState<any>({});
  const [actvebutton, setactvebutton] = useSafeState<number>(1);

  function getStatusString(status: number): string {
      switch (status) {
        case 1:
          return 'hadir';
        case 2:
          return 'hadir';
        case 3:
          return 'sakit';
        case 4:
          return 'ijin';
        case 5:
          return 'alfa';
        default:
          return '';
      }
    }
  const handlePress = (weeknum: number) => {
    setactvebutton(weeknum === actvebutton ? 0 : weeknum);
  };

  //function change status student attandence

  /*  1=hadir,
      2-sakit,
      3=ijin,
      4-tidak hadir */

  //Array count student by status  
  //menampilkan jumlah siswa hadir
  let studentsPresentArray = mappedData.student_list?.filter((student: { status: number; }) => student.status === 1) ?? []
  //menampilkan jumlah siswa sakit
  let studentsSickArray = mappedData.student_list?.filter((student: { status: number; }) => student.status === 2) ?? [];
  //menampilkan jumlah siswa ijin
  let studentsAbsentArray = mappedData.student_list?.filter((student: { status: number; }) => student.status === 3) ?? [];
  //menampilkan jumlah siswa alfa
  let studentsAlphaArray = mappedData.student_list?.filter((student: { status: number; }) => student.status === 4) ?? [];

  let numberStudentsPresent = studentsPresentArray.length;
  let numberStudentsSick = studentsSickArray.length;
  let numberStudentsAbsent = studentsAbsentArray.length;
  let numberStudentsAlpha = studentsAlphaArray.length;

  // filtered data by status
  const filterSickStudents = StudentAttandence?.student_list?.filter((student: { status: number; }) => student.status === 2) ?? []
  const filterAbsentStudents = StudentAttandence?.student_list?.filter((student: { status: number; }) => student.status === 3) ?? []
  const filterAlphaStudents = StudentAttandence?.student_list?.filter((student: { status: number; }) => student.status === 4) ?? []
  const filterPresentStudents = StudentAttandence?.student_list?.filter((student: { status: number; }) => student.status === 1) ?? []

  return (
    <View style={{ flex: 1, backgroundColor: '#ffffff', alignContent: 'center', padding: 10 }}>
      {/* daftar siswa */}
      <FlatList data={studentListAttandence ?? []}
        showsVerticalScrollIndicator={false}
        contentContainerStyle={{ marginTop: LibStyle.STATUSBAR_HEIGHT, backgroundColor: 'white', paddingBottom: 75 }}
        ListHeaderComponent={
          <View >
            <View style={{ flexDirection: 'row', alignItems: 'center', height: 30, justifyContent: 'space-between' }}>
              <Pressable onPress={() => LibNavigation.back()} style={{ alignItems: 'center', }}>
                <View style={{ flexDirection: 'row', alignItems: 'center', marginRight: 20 }}>
                  <LibIcon.EntypoIcons name="chevron-left" size={30} color="black" />
                  <Text style={{ fontSize: 20 }}>{StudentAttandence?.class_name ?? ''}</Text>
                </View>
              </Pressable>
              <Text style={{ fontSize: 20 }}>{time}</Text>
            </View>

            <View style={{ flexDirection: 'row', marginTop: 10, height: 80, justifyContent: 'center', flex: 1,alignItems:'center' }}>
              {/* All student */}
              <View style={{ height: 70, flex: 1, alignItems: 'center', backgroundColor:  1== actvebutton? '#348121':'white', justifyContent: 'center', borderRadius: 10,marginHorizontal:1, borderWidth:2,borderColor: 1== actvebutton? 'white':"#348121"}}>
                <Pressable onPress={() => { setstudentListAttandence(StudentAttandence?.student_list ?? []),handlePress(1)}}style={{alignItems: 'center',padding:5, }}>
                  {/* <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{StudentAttandence?.permission?.total_a ?? '0'}</Text> */}
                  <Text style={{ fontSize: 16, fontWeight: 'bold', color:  1== actvebutton? 'white':'#348121' }}>{StudentAttandence?.student_count ?? '0'}</Text>
                  <Text style={{ fontSize: 10, fontWeight: 'bold', color:  1== actvebutton?'white':'#348121' }} allowFontScaling={true}>Semua Siswa</Text>
                </Pressable>
              </View>
              {/* Berangkat */}
              <View style={{ height: 70, flex: 1, alignItems: 'center', backgroundColor:  2== actvebutton?  'green':'white', justifyContent: 'center', borderRadius: 10,marginHorizontal:1, borderWidth:2,borderColor: 2== actvebutton? 'white':"green"}}>
                <Pressable onPress={() => { setstudentListAttandence(filterPresentStudents),handlePress(2) }}style={{alignItems: 'center',padding:5}}>
                  <Text style={{ fontSize: 16, fontWeight: 'bold', color:  2== actvebutton? 'white':'green' }}>{numberStudentsPresent ?? '0'}</Text>
                  {/* <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{StudentAttandence?.permission?.total_present ?? '0'}</Text> */}
                  <Text style={{ fontSize: 10, fontWeight: 'bold', color:  2== actvebutton? 'white':'green' }} allowFontScaling={true}>Berangkat</Text>
                </Pressable>
              </View>
              {/* Sakit */}
              <View style={{ height: 70, flex: 1, alignItems: 'center', backgroundColor:  3== actvebutton? 'orange':'white', justifyContent: 'center', borderRadius: 10,marginHorizontal:1,borderWidth:2,borderColor: 3== actvebutton? 'white':"orange"}}>
                <Pressable onPress={() => { setstudentListAttandence(filterSickStudents),handlePress(3) }} style={{alignItems: 'center',padding:5}}>
                  {/* <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{StudentAttandence?.permission?.total_s ?? '0'}</Text> */}
                  <Text style={{ fontSize: 16, fontWeight: 'bold', color: 3== actvebutton? 'white':'orange' }}>{numberStudentsSick ?? '0'}</Text>
                  <Text style={{ fontSize: 10, fontWeight: 'bold', color: 3== actvebutton? 'white':'orange' }} allowFontScaling={true}>Sakit</Text>
                </Pressable>
              </View>
              {/* Izin */}
              <View style={{ height: 70, flex: 1, alignItems: 'center', backgroundColor: 4== actvebutton?'#0083fd':'white', justifyContent: 'center', borderRadius: 10,marginHorizontal:1, borderWidth:2,borderColor: 4== actvebutton? 'white':"#0083fd" }}>
                <Pressable onPress={() => { setstudentListAttandence(filterAbsentStudents),handlePress(4) }} style={{alignItems: 'center',padding:5}}>
                  {/* <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{StudentAttandence?.permission?.total_i ?? '0'}</Text> */}
                  <Text style={{ fontSize: 16, fontWeight: 'bold', color:4== actvebutton? 'white':'#0083fd' }}>{numberStudentsAbsent ?? '0'}</Text>
                  <Text style={{ fontSize: 10, fontWeight: 'bold', color:4== actvebutton? 'white':'#0083fd' }} allowFontScaling={true}>Ijin</Text>
                </Pressable>
              </View>
              {/* Alfa */}
              <View style={{ height: 70, flex: 1, alignItems: 'center', backgroundColor:  5== actvebutton?'#FF4343':'white', justifyContent: 'center', borderRadius: 10,marginHorizontal:1 , borderWidth:2,borderColor: 5== actvebutton? 'white':"#FF4343"}}>
                <Pressable onPress={() => { setstudentListAttandence(filterAlphaStudents),handlePress(5) }}style={{alignItems: 'center',padding:5}}>
                  {/* <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{StudentAttandence?.permission?.total_a ?? '0'}</Text> */}
                  <Text style={{ fontSize: 16, fontWeight: 'bold', color: 5== actvebutton? 'white':'#FF4343' }}>{numberStudentsAlpha ?? '0'}</Text>
                  <Text style={{ fontSize: 10, fontWeight: 'bold', color: 5== actvebutton? 'white':'#FF4343' }} allowFontScaling={true}>Alfa</Text>
                </Pressable>
              </View>
              

            </View>
            {/* seperator */}
            <View style={{ height: 5, width: 'auto', backgroundColor: 'gray', marginHorizontal: 10, justifyContent: 'center', borderRadius: 5, marginTop: 12 }} />
          </View>
        }
        ListEmptyComponent={() => {
          return (
            <View style={{ flex: 1, justifyContent: 'center', alignItems: 'center',marginTop:20 }}>
              <Text style={{ fontSize: 16, fontWeight: 'bold' }}>Tidak ada data murid yang {getStatusString(actvebutton)}</Text>
            </View>
          )
        }
        }
        keyExtractor={(item, index) => index.toString()}
        renderItem={
          ({ item }) => {

            function getStudentStatus(statusCode: number) {
              let status = '';

              switch (statusCode) {
                case 1:
                  status = 'Hadir';
                  break;
                case 2:
                  status = 'Sakit';
                  break;
                case 3:
                  status = 'Ijin';
                  break;
                case 4:
                  status = 'Tidak Hadir';
                  break;
                default:
                  status = 'Unknown';
              }

              return status;
            }
            function getStudentColor(statusCode: number) {
              let color = '';

              switch (statusCode) {
                case 1:
                  color = '#0DBD5E';
                  break;
                case 2:
                  color = 'orange';
                  break;
                case 3:
                  color = '#0083fd';
                  break;
                case 4:
                  color = '#FF4343';
                  break;

                default:
                  color = 'Unknown';
              }

              return color;
            }
            return (
              <Pressable onPress={() => { }} style={{ flexDirection: 'row', justifyContent: 'flex-start', marginTop: 10, alignItems: 'center', borderColor: getStudentColor(item?.status), borderWidth: 3, borderRadius: 12, height: 90 }}>
                <View style={{ height: 90, width: 10, borderBottomLeftRadius: 10, borderTopLeftRadius: 10, backgroundColor: getStudentColor(item?.status), }} />
                <Text style={{ fontSize: 20, fontWeight: 'bold', marginHorizontal: 20, color: getStudentColor(item?.status) }}>{item?.number ?? 0}</Text>
                <View style={{ height: 90, width: 2, backgroundColor: getStudentColor(item?.status), }} />

                <View style={{ marginLeft: 10, alignItems: 'flex-start', justifyContent: 'center' }}>
                  <Text style={{ fontSize: 16, fontWeight: 'bold' }}>{String(item?.name)} </Text>

                  <View style={{ alignItems: 'center', padding: 5, backgroundColor: getStudentColor(item?.status), borderRadius: 5, justifyContent: 'center', marginTop: 10 }}>
                    <Text style={{ fontSize: 14, fontWeight: 'bold', color: 'white' }}>{getStudentStatus(item?.status)} {item?.notes ?? ''} </Text>
                  </View>
                </View>
              </Pressable>
            )
          }} />


    </View>
  )
}